<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ReportsService;
use App\Http\Requests\StoreReportRequest;

class ReportsController extends Controller
{
    protected $service;

    public function __construct(ReportsService $service)
    {
        $this->service = $service;
    }

   public function index(){
    return $this->service->getAllReport();
   }
   public function store(StoreReportRequest $request){
    return $this->service->storeReport($request->all());
   }
    

}
