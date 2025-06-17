<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Report;
use App\Repositories\Api\Contracts\ReportsRepositoryInterface;

class ReportsRepository implements ReportsRepositoryInterface
{
    // implement methods
    protected $report;
    public function __construct(Report $report)
    {
        $this->report = $report;    

    }
        public function getAllReport(){
            return $this->report->all(); // Fetch all reports

        }
    public function storeReport($data){
        // Store a new report
        return $this->report->create($data);

    }

}
