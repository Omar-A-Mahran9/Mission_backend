<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\OfferLogs;
use App\Models\Offer;
use App\Repositories\Api\Contracts\OfferLogsRepositoryInterface;

class OfferLogsRepository implements OfferLogsRepositoryInterface
{

    protected $offerLogs;   
    protected $offer;   
    public function __construct(OfferLogs $offerLogs,Offer $offer)
    {

        $this->offerLogs = $offerLogs;  
        $this->offer = $offer;  
        // You can inject any dependencies here if needed
    }
   public function taskHandOver($data){
        //the function reposnsible for freelancer to hand over the task to the client
        return $this->offerLogs->create($data);
    }
    public function cancelOffer($data){
          return  $this->offerLogs->create($data);
    }

    public function userOfferLogs($offerId)
    {
        // Fetch the offer logs for a specific offer
        return $this->offer->where('id', $offerId)
        // ->where('user_id', auth()->id()) // u need to delete this line
             ->first();
    }

        public function CloseTheOffers($offerId){
              return  $this->offerLogs->where('offer_id', $offerId)
              ->get(); 
        }
    
 
}
