<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Field;
use App\Repositories\Api\Contracts\HomeRepositoryInterface;

class HomeRepository implements HomeRepositoryInterface
{
    public function index()
    {
        $cityId = auth()->user()->city_id;
        $fieldId = auth()->user()->field_id;
        dd(auth()->user(), Field::withCount('missions')->orderBy('missions_count', 'desc')->get());
    }
}
