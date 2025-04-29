<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Faqs;
use App\Models\Interest;
use App\Repositories\Api\Contracts\FaqRepositoryInterface;

class FaqRepository implements FaqRepositoryInterface
{

    public function index()
    {
        return Faqs::get();
    }
}
