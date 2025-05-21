<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Field;
use App\Models\Skill;
use App\Repositories\Api\Contracts\FieldRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FieldRepository implements FieldRepositoryInterface
{
    public function index($request)
    {
        return Field::query()->when($request->filled('search'), function ($query) use ($request) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_ar', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%");
            });
        })->get();
    }
    public function fieldSkils()
    {
        return ["field" => auth()->user()->field->id, "skills" => auth()->user()->skills, "specialists" => auth()->user()->specialists->pluck('id')];
    }
    public function update($data)
    {
        $user = auth()->user();
        $field = Field::findOrFail($data['field_id']);
        $user = DB::transaction(function () use ($data, $user, $field) {
            if (isset($data["skills_name"])) {
                $skillKey = 'name_ar';
                foreach ($data['skills_name'] as $skill) {
                    if ($this->isArabic($skill)) $skillKey = 'name_ar';
                    elseif ($this->isPureEnglish($skill)) $skillKey = 'name_en';
                    Skill::create([$skillKey => $skill]);
                }
            }
            if ($field->id !== $user->field_id && $field->is_critical) {
                $user->is_valid = 0;
            }
            $user->field_id = $field->id;
            $user->save();
            $user->skills()->sync($data['skill_ids']);
            $user->specialists()->sync($data['specialist_ids']);
            return $user;
        });
        $user->load(['field', 'skills', 'specialists']);
        return ["field" => auth()->user()->field->id, "skills" => auth()->user()->skills, "specialists" => auth()->user()->specialists->pluck('id')];
    }

    function isArabic($text)
    {
        return preg_match('/\p{Arabic}/u', $text);
    }
    function isPureEnglish($text)
    {
        return preg_match('/^[A-Za-z\s]+$/', $text);
    }
}
