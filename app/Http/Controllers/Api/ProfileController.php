<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\ProfileService;
use App\Http\Resources\Api\ProfileResource;
use App\Http\Requests\Api\StoreOverViewRequest;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }
    public function overView()
    {
        return $this->success("", new ProfileResource($this->service->overView()));
    }

    public function update(StoreOverViewRequest $request)
    {
        return $this->success("", new ProfileResource($this->service->store($request)));
    }
}
