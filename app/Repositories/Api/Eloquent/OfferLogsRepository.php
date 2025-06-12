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
              ->first();
    }

        public function CloseTheOffers($offerId,$statusId){
              return  $this->offer->where('id', $offerId)
              ->first()->update(['status_id' => $statusId]); // Assuming 3 is the ID for 'closed' status
        }
    
 public function userOfferLogsById($offerId){
    // Fetch the offer logs for a specific offer by ID
    return $this->offerLogs->where('offer_id', $offerId)
        ->get();
 }

 public function isUserChangeOfferStatus($offerId, $userId)
    {
        // Check if the user is authorized to change the offer status
        return $this->offerLogs->where('offer_id', $offerId)
            ->where('user_id', $userId)
            ->exists();
    }
}
