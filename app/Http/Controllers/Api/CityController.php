<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Api\CityService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;

class CityController extends Controller
{
    protected $service;

    public function __construct(CityService $service)
    {
        $this->service = $service;
    }
    public function index(Request $request)
    {
        return $this->successWithPagination("", CityResource::collection($this->service->index())->response()->getData(true));
    }
}
