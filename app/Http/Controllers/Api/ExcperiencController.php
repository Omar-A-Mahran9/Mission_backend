<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\ExcperiencService;
use App\Http\Resources\Api\SkillResource;
use App\Http\Resources\Api\SpecialistResource;
use App\Http\Resources\Api\ExcperienceResource;
use App\Http\Requests\Api\StoreExcperiencRequest;

class ExcperiencController extends Controller
{
    protected $service;

    public function __construct(ExcperiencService $service)
    {
        $this->service = $service;
    }
    public function specialists($id)
    {
        return $this->success("", SpecialistResource::collection($this->service->specialists($id)));
    }
    public function skills()
    {
        return $this->success("", SkillResource::collection($this->service->skills()));
    }
    public function store(StoreExcperiencRequest $request)
    {
        return $this->success("", $this->service->store($request));
    }
    public function show()
    {
        return $this->success("", new ExcperienceResource($this->service->show()));
    }
    public function update(Request $request, $id)
    {
        return $this->success("", []);
    }
    public function destroy($id)
    {
        return $this->success("", []);
    }
}
