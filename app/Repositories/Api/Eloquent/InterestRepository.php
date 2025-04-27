<?php

namespace App\Repositories\Api\Eloquent;


use App\Models\Interest;
use App\Repositories\Api\Contracts\InterestRepositoryInterface;

class InterestRepository implements InterestRepositoryInterface
{
    public function index()
    {
        return Interest::paginate(50);
    }
}
