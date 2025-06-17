<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\OffersService;

class OffersController extends Controller
{
    protected $service;

    public function __construct(OffersService $service)
    {
        $this->service = $service;
    }

    public function userOffers($user_id){

        return $this->service->userOffers($user_id);
    }
}
