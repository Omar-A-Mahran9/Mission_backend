<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\Contracts\ReportsRepositoryInterface;

class ReportsService
{
    protected $reportsRepository;

    public function __construct(ReportsRepositoryInterface $reportsRepository)
    {
        $this->reportsRepository = $reportsRepository;
      }
      
      public function getAllReport(){
        
        return response()->json($this->reportsRepository->getAllReport());
        
      }
      public function storeReport($data){
        
        return $this->reportsRepository->storeReport($data);
        
      }

      public function updateReport($data,$id)
      
      {

      return $this->reportsRepository->updateReport($id)->update($data);

     }
      public function delete($id)
      
      {

      return $this->reportsRepository->delete($id);

     }
}
