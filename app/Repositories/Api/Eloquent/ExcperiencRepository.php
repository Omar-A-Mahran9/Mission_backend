<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Field;
use App\Models\Skill;
use App\Models\Interest;
use App\Models\Specialist;
use App\Models\SpecialistUser;
use App\Models\SupportMessage;
use App\Models\FieldSpecialist;
use Illuminate\Support\Facades\DB;
use App\Repositories\Api\Contracts\ExcperiencRepositoryInterface;

class ExcperiencRepository implements ExcperiencRepositoryInterface
{ 
    public function specialists($id)
    {
        return Field::find($id)->specialists()->get();
    }
    public function store($data)
    {
        try {
            DB::transaction(function () use ($data) {
                $experience = auth()->user()->experiences()->create(["field_id" => $data['field_id']]);
                $experience->specialists()->sync($data['specialist_ids']);
                $experience->skills()->sync($data['skill_ids']);
            });
            return auth()->user()
                ->experiences()
                ->with(['skills', 'specialists', 'field'])
                ->latest()
                ->first();
        } catch (\Throwable $e) {
            return false;
        }
    }
    public function skills()
    {
        return Skill::all();
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
    public function show()
    {
        return auth()->user()->load('experiences.skills', 'experiences.specialists', 'experiences.field');
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
