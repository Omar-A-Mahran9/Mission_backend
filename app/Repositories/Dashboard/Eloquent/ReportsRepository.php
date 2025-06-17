<?php

namespace App\Repositories\Dashboard\Eloquent;

use App\Models\Report;
use App\Repositories\Dashboard\Contracts\ReportsRepositoryInterface;

class ReportsRepository implements ReportsRepositoryInterface
{
    private $report;
    public function __construct(Report $report){
        $this->report = $report;
    }
         public function getAllReport(){

            return $this->report->paginate(10);


        }
        public function updateReport($id){
            return $this->report->findOrFail($id);
        }


        public function storeReport($data){
            return $this->report->create($data);
        }

                public function delete($id){
            return $this->report->findOrfail($id)->delete();

                }

        }


