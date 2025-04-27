<?php

namespace App\Services\Api;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Api\Eloquent\CityRepository;

class CityService
{
    protected $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        return $this->cityRepository->index();
    }
}
