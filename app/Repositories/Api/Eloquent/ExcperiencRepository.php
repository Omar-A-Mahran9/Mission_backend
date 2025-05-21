<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Field;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;
use App\Repositories\Api\Contracts\ExcperiencRepositoryInterface;

class ExcperiencRepository implements ExcperiencRepositoryInterface
{
    public function specialists($request, $id)
    {
        return Field::find($id)->specialists()->when($request->filled('search'), function ($query) use ($request) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_ar', 'like', "%{$search}%")
                    ->orWhere('name_en', 'like', "%{$search}%");
            });
        })->get();
    }

    public function store($data)
    {
        try {
            $experience = DB::transaction(function () use ($data) {
                $experience = auth()->user()->experiences()->create(["title" => $data['title'], "description" => $data['description']]);
                return $experience;
            });
            return $experience;
        } catch (\Throwable $e) {
            return false;
        }
    }
    public function skills($request)
    {
        $search = $request->search;
        if (!$search) return [];
        $isArabic = preg_match('/\p{Arabic}/u', $search);
        $skills = Skill::query()->where(function ($q) use ($search) {
            $q->where('name_ar', 'like', "%{$search}%")
                ->orWhere('name_en', 'like', "%{$search}%");
        })
            ->get();
        return $skills->map(function ($skill) use ($isArabic) {
            return [
                'id' => $skill->id,
                'name' => $isArabic ? $skill->name_ar : $skill->name_en,
            ];
        });
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
                    $experience->update(["title" => $data['title'], "description" => $data['description']]);
                }
            });
            return $experience;
        } catch (\Throwable $e) {
            return false;
        }
    }
    public function show()
    {
        return auth()->user()->load('experiences');
    }
    public function destroy($id)
    {
        try {
            $experience = auth()->user()->experiences()->find($id);
            if (!$experience) {
                return false;
            }
            DB::transaction(function () use ($experience) {
                $experience->delete();
            });
            return auth()->user()
                ->experiences()
                ->get();
        } catch (\Throwable $e) {
            return false;
        }
    }
}
