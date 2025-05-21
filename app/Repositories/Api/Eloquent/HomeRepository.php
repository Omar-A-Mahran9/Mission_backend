<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\User;
use App\Models\Field;
use App\Models\Mission;
use App\Models\Specialist;
use App\Models\FieldSpecialist;
use App\Repositories\Api\Contracts\HomeRepositoryInterface;

class HomeRepository implements HomeRepositoryInterface
{
    public function index()
    {
        // $cityId = auth()->user()->city_id;
        $fieldId = auth()->user()->field_id;
        $userSpecialistIds = auth()->user()->specialists()->get()->pluck('id')->toArray();

        $fields = Field::withCount('missions')->orderByRaw('id = ? DESC', [$fieldId])->orderBy('missions_count', 'desc')->get();
        $specialists = Field::with('specialists')->find($fieldId)->specialists
            ->sortByDesc(function ($item) use ($userSpecialistIds) {
                return in_array($item->id, $userSpecialistIds) ? 1 : 0;
            })
            ->values();
        $missions = Field::find($fieldId)->missions()->with('user')->withCount('offers')->get();
        $professionals = User::where(function ($query) use ($fieldId) {
            $query->where('field_id', $fieldId)->where('is_valid', 1)->where('id', '!=', auth()->user()->id);
        })->with('specialists')->get();
        dd($professionals);
        return ["fields" => $fields, "field_name" => auth()->user()->field->name, "specialists" => $specialists, "missions" => $missions];
    }
}
