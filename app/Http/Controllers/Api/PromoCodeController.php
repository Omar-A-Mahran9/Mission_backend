<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PromoCodeResource;
use App\Services\Api\PromoCodeService;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    protected $service;

    public function __construct(PromoCodeService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return $this->success("", PromoCodeResource::collection($this->service->index($request)));
    }
}
