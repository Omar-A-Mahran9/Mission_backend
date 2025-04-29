<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\City;
use App\Models\Field;
use App\Repositories\Api\Contracts\FieldRepositoryInterface;

class FieldRepository implements FieldRepositoryInterface
{
    public function index()
    {
        return Field::get();
    }
}
