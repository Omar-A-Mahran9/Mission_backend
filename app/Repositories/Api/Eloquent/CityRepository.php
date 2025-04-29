<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\City;
use App\Repositories\Api\Contracts\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface
{
    public function index()
    {
        return City::get();
    }
}
