<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMissionRequest;
use App\Http\Requests\Api\UpdateMissionRequest;
use App\Http\Resources\Api\MissionResource;
use App\Models\Mission;
use App\Services\Api\MissionService;
use Illuminate\Http\Request;

class MissionController extends Controller
{


    protected $service;

    public function __construct(MissionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->success("Missions fetched successfully", MissionResource::collection($this->service->index()));

    }


    public function store(StoreMissionRequest $request)
    {
        $validated = $request->validated();

        // Call the service to store the mission
        $mission = $this->service->store($validated);

        return $this->success('Mission created successfully!', new MissionResource($mission));

    }


    public function update(UpdateMissionRequest $request, $id)
    {
        $validated = $request->validated();  // Validate the incoming request data

        $mission = $this->service->update($id, $validated);

        return $this->success('Mission updated successfully!', new MissionResource($mission));

    }

    public function destroy($id)
    {
        try {
            $deleted = $this->service->destroy($id);

            if (!$deleted) {
                return $this->failure('Failed to delete the mission.');


            }


            return $this->success('Mission deleted successfully.');

        } catch (\Exception $e) {
            return $this->failure('Mission not found or an error occurred.');
        }
    }

    public function show($id)
    {
        return $this->success("Missions fetched successfully", new MissionResource($this->service->show($id)));
    }

        public function getDoneMission()
    {
       return $this->service->getDoneMission();
    }
    public function getCurrentMission()
    {
       return $this->service->getCurrentMission();
    }

}
