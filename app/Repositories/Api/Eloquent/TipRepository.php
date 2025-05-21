<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Tip;
use App\Repositories\Api\Contracts\TipRepositoryInterface;

class TipRepository implements TipRepositoryInterface
{

    public function index()
    {
        return Tip::get();
    }
}
