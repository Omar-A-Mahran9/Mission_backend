<?php

namespace App\Repositories\Api\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Repositories\Api\Contracts\LicenseRepositoryInterface;

class LicenseRepository implements LicenseRepositoryInterface
{
    public function index()
    {
        return auth()->user()->licenses()
            ->with('files') // eager load files for performance
            ->get();
    }

    public function store($data)
    {
        try {
            DB::transaction(function () use ($data) {
                $certificate = auth()->user()->licenses()->create([
                    'name' => $data['name'],
                    'type_id' => 2,
                    'expiration_date' => $data['expiration_date'],
                    'have_expiration_date' => $data['have_expiration_date']
                ]);
                foreach ($data['files'] as $file) {
                    $certificate->files()->create(['file' => uploadImageToDirectory($file, "Documents")]);
                }
            });
            return auth()->user()
                ->licenses()
                ->with(['files'])
                ->latest()
                ->first();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function update($data, $id)
    {
        try {
            $certificate = auth()->user()->licenses()->with("files")->find($id);
            if (!$certificate) {
                return false;
            }
            $deletedFileIds = $data['deleted_files'] ?? [];
            $matchedFiles = $certificate->files()->whereIn('id', $deletedFileIds)->get();
            if (count($matchedFiles) !== count($deletedFileIds)) {
                return false;
            }
            DB::transaction(function () use ($data, $certificate, $matchedFiles) {

                $certificate->update([
                    'name' => $data['name'],
                    'expiration_date' => $data['expiration_date'] ?? null,
                    'have_expiration_date' => $data['have_expiration_date'],
                    'is_review' => 0
                ]);

                if ($matchedFiles) {
                    deleteImagesFromDirectory($matchedFiles->pluck('file'), "Documents");
                    $matchedFiles->each->delete();
                }
                if (isset($data['files'])) {
                    foreach ($data['files'] as $file) {
                        $certificate->files()->create(['file' => uploadImageToDirectory($file, "Documents")]);
                    }
                }
            });
            return $certificate->load('files');
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $certificate = auth()->user()->licenses()->find($id);
            if (!$certificate) {
                return false;
            }
            DB::transaction(function () use ($certificate) {
                $certificate->files()->each(function ($file) {
                    deleteImageFromDirectory($file->file, "Documents");
                    $file->delete();
                });
                $certificate->delete();
            });
            return auth()->user()
                ->licenses()
                ->with(['files'])
                ->get();
        } catch (\Throwable $e) {
            return false;
        }
    }
}
