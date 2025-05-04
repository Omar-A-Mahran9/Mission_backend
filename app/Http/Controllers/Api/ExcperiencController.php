<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\ExcperiencService;
use App\Http\Resources\Api\SkillResource;
use App\Http\Resources\Api\SpecialistResource;
use App\Http\Resources\Api\ExcperienceResource;
use App\Http\Requests\Api\StoreExcperiencRequest;
use App\Http\Requests\Api\UpdateExcperienceRequest;

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
        $created = $this->service->store($request);
        if (!$created) {
            return $this->failure(__('Error in creating experience'));
        }
        return $this->success('', new ExcperienceResource($created));
    }
    public function index()
    {
        return $this->success("",  ExcperienceResource::collection($this->service->show()->experiences));
    }
    public function update(UpdateExcperienceRequest $request, $id)
    {
        $updated = $this->service->update($request, $id);
        if (!$updated) {
            return $this->failure(__('Error in updating experience'));
        }
        return $this->success('', new ExcperienceResource($updated));
    }
    public function destroy($id)
    {
        $deleted = $this->service->destroy($id);
        if (!$deleted) {
            return $this->failure(__('Error in deleting experience'));
        }
        return $this->success("",  ExcperienceResource::collection($deleted));
    }
}
