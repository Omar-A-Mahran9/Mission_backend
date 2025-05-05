<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Field;
use App\Models\Skill;
use App\Models\Interest;
use App\Models\Specialist;
use App\Models\SpecialistUser;
use App\Models\SupportMessage;
use App\Models\FieldSpecialist;
use App\Repositories\Api\Contracts\CertificateRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Api\Contracts\ExcperiencRepositoryInterface;

class CertificateRepository implements CertificateRepositoryInterface
{
    public function index()
    {
        return auth()->user()->certificates()
            ->with('files') // eager load files for performance
            ->get();
    }

    public function store($data)
    {
        try {
            DB::transaction(function () use ($data) {
                $certificate = auth()->user()->certificates()->create([
                    'name' => $data['name'],
                    'type_id' => 1,
                    'expiration_date' => $data['expiration_date'],
                    'have_expiration_date' => $data['have_expiration_date']
                ]);
                foreach ($data['files'] as $file) {
                    $certificate->files()->create(['file' => uploadImageToDirectory($file, "Documents")]);
                }
            });
            return auth()->user()
                ->certificates()
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
            $certificate = auth()->user()->certificates()->with("files")->find($id);
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
                    'have_expiration_date' => $data['have_expiration_date']
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
            $certificate = auth()->user()->certificates()->find($id);
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
                ->certificates()
                ->with(['files'])
                ->get();
        } catch (\Throwable $e) {
            return false;
        }
    }
}
