<?php

namespace App\Services\Api;

use App\Repositories\Api\Contracts\ReportsRepositoryInterface;
use App\Traits\RespondsWithHttpStatus;
use DB;
use App\Http\Resources\ReportReource;
class ReportsService
{

    use RespondsWithHttpStatus;
    protected $reportsRepository;

    public function __construct(ReportsRepositoryInterface $reportsRepository)
    {
        $this->reportsRepository = $reportsRepository;
    }

    

    public function getAllReport()
    {
        $data= $this->reportsRepository->getAllReport();
        return             ReportReource::collection($data);

    }

    public function storeReport($data)
    {
        //check if the user id and mission id exxcit
   $missionReportExist =  DB::table('mission_reports')->where(
    'mission_id',$data['mission_id']
   )->where('user_id', auth()->id())
         ->exists();

        if ($missionReportExist) {
            return $this->errorModel(
                __('report already exists for this mission'),
                'report exists',
                422
            );
        }

        // Check if the mission exists
        $missionExists = DB::table('missions')->where('id', $data['mission_id'])->exists();
        if (!$missionExists) {
            return $this->error(
                __('mission not found'),
                404
            );
        }

        // Check if the user is authorized to report on this mission
        $isAuthorized = DB::table('missions')
            ->where('id', $data['mission_id'])
            ->where('user_id', auth()->id())
            ->exists();

        if (!$isAuthorized) {
            return $this->error(
                __('unauthorized action'),
                403
            );
        }

        // Proceed to insert the report
        $missionReportExist = DB::table('mission_reports')
            ->where('mission_id', $data['mission_id'])
            ->where('user_id', auth()->id())
   
   ->get();

        dd($missionReportExist);
         $reportData = array_merge($data, [
        'user_id' => auth()->id(),
                'created_at' => now(), // Current timestamp
        'updated_at' => now(), // Current timestamp

    ]);
    DB::table('mission_reports')->insert($reportData);

         return $this->created(
            __('report created successfully'),
              
        );
    }
}
