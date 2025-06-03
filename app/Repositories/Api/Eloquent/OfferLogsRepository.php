<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\OfferLogs;
use App\Repositories\Api\Contracts\OfferLogsRepositoryInterface;

class OfferLogsRepository implements OfferLogsRepositoryInterface
{

    protected $offerLogs;   
    public function __construct(OfferLogs $offerLogs)
    {

        $this->offerLogs = $offerLogs;  
        // You can inject any dependencies here if needed
    }
   public function taskHandOver($data){
        //the function reposnsible for freelancer to hand over the task to the client
        return $this->offerLogs->create($data);
    }
    public function cancelOffer($data){
          return  $this->offerLogs->create($data);
    }
}
