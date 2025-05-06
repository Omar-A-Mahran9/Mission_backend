<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mission $mission)
    {
        //
    }
}
