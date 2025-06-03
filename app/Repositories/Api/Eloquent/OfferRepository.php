<?php

namespace App\Repositories\Api\Eloquent;
use App\Models\Offer;

use App\Models\OfferLogs;
use App\Models\Status;
use App\Repositories\Api\Contracts\OfferRepositoryInterface;

class OfferRepository implements OfferRepositoryInterface
{
    // implement methods

    protected $offer;   
    public function __construct(Offer $offer)
    {

        $this->offer = $offer;  
        // You can inject any dependencies here if needed
    }

    public function createOffer(array $data){

      return  $this->offer->create($data);

    }

    public function getDoneOffers($status_id){

     return $this->offer
    ->with(['mission.specialist', 'status'])  // <- eager load related models
    ->where('user_id', auth()->id())
    ->whereIn('status_id', $status_id)
    ->get();

 
    }
    public function getCurrentOffers($status_id){
                return $this->offer
                
    ->with(['mission.specialist', 'status'])->  // <- eager load related models
                
                where('user_id', auth()->id())
                           ->where('status_id', $status_id)
                           ->get();

    }

    //with mission data
    public function getOfferById(int $id){
        $offer = $this->offer->find($id);

    if (!$offer) {
        return null;
    }

    return $offer->load('mission', 'user', 'status');        
    }
   
    public function acceptOffer(int $offerId, int $userId){

        $status = Status::where('name_en', 'Accepted')->first();

        return $this->offer->where('id', $offerId)
            ->where('user_id', $userId)
            ->update(['status_id' => $status->id]);  // Update the status to 'Accepted'     
          ; // Assuming 2 is the ID for 'Accepted' status
    }
    public function rejectOfferByClient(int $offerId, int $userId){
                $status = Status::where('name_en', 'Cancelled')->first();

        return $this->offer->where('id', $offerId)
            ->where('user_id', $userId)
            ->update(['status_id' => $status->id]);  // Update the status to 'Accepted'     
          ; // Assuming 2 is the ID for 'Accepted' status

    }


}
