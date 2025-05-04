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
            $experience = auth()->user()->experiences()->find($id);
            if (!$experience) {
                return false;
            }
            DB::transaction(function () use ($data, $experience) {
                if ($experience) {
                    $experience->update(["field_id" => $data['field_id']]);
                    $experience->specialists()->sync($data['specialist_ids']);
                    $experience->skills()->sync($data['skill_ids']);
                }
            });
            $experience->load(['field', 'skills', 'specialists']);

            return $experience;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            $experience = auth()->user()->experiences()->find($id);
            if (!$experience) {
                return false;
            }
            DB::transaction(function () use ($experience) {
                $experience->specialists()->detach();
                $experience->skills()->detach();
                $experience->delete();
            });
            return auth()->user()
                ->experiences()
                ->with(['skills', 'specialists', 'field'])
                ->get();
        } catch (\Throwable $e) {
            return false;
        }
    }
}
