<?php

namespace App\Services\Api;

use App\Repositories\Api\Contracts\ReportsRepositoryInterface;
use App\Traits\RespondsWithHttpStatus;
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
        return $this->success(
            __('data fetched successfully'),
            200,
            $data
        );
    }

    public function storeReport($data)
    {
         $this->reportsRepository->storeReport($data);

         return $this->created(
            __('messages.report_created_successfully'),
              
        );
    }
}
