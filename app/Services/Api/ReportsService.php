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
    // Ensure report_ids are integers
    $reportIds = array_map('intval', 
        is_array($data['report_id']) ? $data['report_id'] : [$data['report_id']]
    );
    // Check existing reports
    $existingReports = DB::table('mission_reports')
        ->where('mission_id', $data['mission_id'])
        ->where('user_id', auth()->id())
        ->whereIn('report_id', $reportIds)
        ->pluck('report_id')
        ->toArray();

    if (!empty($existingReports)) {
        return $this->errorModel(
            __('Reports already exist: ') . implode(', ', $existingReports),
            'reports_exist',
            422
        );
    }

    // Prepare data with proper typing
    $reportsData = [];
    $now = now();
    
    foreach ($reportIds as $reportId) {
        $reportsData[] = [
            'mission_id' => (int)$data['mission_id'],
            'report_id' => (int)$reportId,
            'user_id' => (int)auth()->id(),
'details' => $reportId === 4 ? ($data['details'] ?? null) : null,
            'created_at' => $now,
            'updated_at' => $now
        ];
    }

    // Insert with error handling
         DB::table('mission_reports')->insert($reportsData);
    

    return $this->created(
        __('Reports created successfully'),
    );
}


}
