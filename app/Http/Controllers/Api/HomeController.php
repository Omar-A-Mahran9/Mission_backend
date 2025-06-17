<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\HomeService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\FieldResource;
use App\Http\Resources\Api\SpecialistResource;
use App\Http\Resources\Api\MissionHomeResource;
use App\Http\Resources\Api\ProfessionalResource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $service;

    public function __construct(HomeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $result = $this->service->index();
        return $this->success("", [
            "fields" => FieldResource::collection($result['fields']),
            "field_name" => $result['field_name'],
            "specialists" => SpecialistResource::collection($result['specialists']),
            "missions" => MissionHomeResource::collection($result['missions']),
            "professionals" => ProfessionalResource::collection($result['professionals'])
        ]);
    }

    public function search(Request $request)
    {
        $result = $this->service->search($request);
        return $this->success("", $result);
    }
    public function goTosearch(Request $request)
    {
        $result = $this->service->goTosearch($request);
        return $this->success("", $result);
    }
}
