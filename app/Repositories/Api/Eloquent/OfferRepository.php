<?php

namespace App\Repositories\Api\Eloquent;
use App\Models\Offer;

use App\Models\OfferLogs;
use App\Models\Status;
use App\Repositories\Api\Contracts\OfferRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class OfferRepository implements OfferRepositoryInterface
{
    // implement methods

    protected $offer;   
    public function __construct(Offer $offer)
    {

        $this->offer = $offer;  
        // You can inject any dependencies here if needed
    }
    public function getOfferByMission($mission_Id){
        return $this->offer
            ->with(['mission.specialist', 'status'])  // <- eager load related models
            ->where('mission_id', $mission_Id)
            ->paginate(12);
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
   
    public function acceptOffer(int $offerId){

        $status = Status::where('name_en', 'Accepted')->first();

        $this->offer->where('id', $offerId)
            ->update(['status_id' => $status->id]);  // Update the status to 'Accepted'     
          ; // Assuming 2 is the ID for 'Accepted' status
 

    }
    public function rejectOfferByClient($mission_id){
                $status = Status::where('name_en', 'Cancelled')->first();

        return $this->offer
        ->where('mission_id', $mission_id)
            ->update(['status_id' => $status->id]);  // Update the status to 'Accepted'     
          ; // Assuming 2 is the ID for 'Accepted' status

    }

   public function filterOfferByPriceAndRate($mission_id){
    // Return the query builder, don't call get() here
    return $this->offer->with(['status'])
        ->where('mission_id', $mission_id);
}

 
    public function withUserAndRating(Builder $query, int $missionId)
    {
        return $query->with([
            'user' => function ($query) use ($missionId) {
                $query->with(['city'])
                    ->withAvg([
                        'reviews as average_rating' => function ($q) use ($missionId) {
                            $q->where('mission_id', $missionId);
                        }
                    ], 'rate');
            }
        ]);
    }

    public function orderByAverageRating(Builder $query, string $direction, int $missionId)
    {
        return $query->orderBy(
            \App\Models\Rate::selectRaw('AVG(rate)')
                ->whereColumn('profissionalist_id', 'offers.user_id')
                ->where('mission_id', $missionId)
                ->groupBy('profissionalist_id'),
            $direction
        );
    }


}
