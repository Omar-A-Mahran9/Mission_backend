<?php

namespace App\Repositories\Api\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Repositories\Api\Contracts\PortfolioRepositoryInterface;

class PortfolioRepository implements PortfolioRepositoryInterface
{
    public function index()
    {
        return auth()->user()->portfolios()
            ->with('files') // eager load files for performance
            ->get();
    }

    public function store($data)
    {
        try {
            $portfolio = DB::transaction(function () use ($data) {

                $portfolio = auth()->user()->portfolios()->create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                ]);

                foreach ($data['files'] as $file) {
                    $portfolio->files()->create(['file' => uploadImageToDirectory($file, "Portfolios")]);
                }
                return $portfolio;
            });
            return $portfolio->load('files');
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function update($data, $id)
    {
        try {
            $portfolio = auth()->user()->portfolios()->with("files")->find($id);
            if (!$portfolio) {
                return false;
            }
            $deletedFileIds = $data['deleted_files'] ?? [];
            $matchedFiles = $portfolio->files()->whereIn('id', $deletedFileIds)->get();
            if (count($matchedFiles) !== count($deletedFileIds)) {
                return false;
            }
            DB::transaction(function () use ($data, $portfolio, $matchedFiles) {

                $portfolio->update([
                    'title' => $data['title'],
                    'description' => $data['description'],
                ]);

                if ($matchedFiles) {
                    deleteImagesFromDirectory($matchedFiles->pluck('file'), "Portfolios");
                    $matchedFiles->each->delete();
                }
                if (isset($data['files'])) {
                    foreach ($data['files'] as $file) {
                        $portfolio->files()->create(['file' => uploadImageToDirectory($file, "Portfolios")]);
                    }
                }
            });
            return $portfolio->load('files');
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $portfolio = auth()->user()->portfolios()->with("files")->find($id);
            if (!$portfolio) {
                return false;
            }
            DB::transaction(function () use ($portfolio) {
                deleteImagesFromDirectory($portfolio->files->pluck('file'), "Portfolios");
                $portfolio->delete();
            });
            return auth()->user()->portfolios()
                ->with('files') // eager load files for performance
                ->get();
        } catch (\Throwable $e) {
            return false;
        }
    }
}
