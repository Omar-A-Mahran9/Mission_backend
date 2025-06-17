<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReport;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use App\Services\Dashboard\ReportsService;

class ReportsController extends Controller
{
    protected $service;

    public function __construct(ReportsService $service)
    {
        $this->service = $service;
    }


      public function index(){

        return view('dashboard.missionReport.index');
         }
      public function edit(Report $report){

        return view('dashboard.missionReport.edit',compact('report'));
      }
      public function storeForm(){
        
        return view('dashboard.missionReport.create');
         }



         public function storeReport(StoreReport $request){

            $this->service->storeReport($request->all());
          return response()->json([
                'message' => 'Report created successfully.',
                'redirect_url' => route('dashboard.report.index')  // or your named route
            ]);
         }
         public function getAllReport(){
            return $this->service->getAllReport();
             
         } 


         public function updateReport(UpdateReportRequest $request,$report){
             $this->service->updateReport($request->all(),$report);

             return response()->json([
                'message' => 'Report Updated successfully.',
                'redirect_url' => route('dashboard.report.index')  // or your named route
            ]);
             
         } 
         public function delete($id){
             $this->service->delete($id);

             return response()->json([
                'message' => 'Report Deleted successfully.',
                'redirect_url' => route('dashboard.report.index')  // or your named route
            ]);
             
         } 
}


