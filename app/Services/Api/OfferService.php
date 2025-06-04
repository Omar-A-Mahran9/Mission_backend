<?php

namespace App\Services\Api;

use App\Http\Requests\Api\AcceptOfferRequest;
use App\Http\Requests\Api\StoreOffer;
use App\Http\Resources\Api\OfferResource;
use App\Http\Resources\Api\OffersResource;
use App\Models\Status;
use App\Repositories\Api\Contracts\OfferRepositoryInterface;
use App\Repositories\Api\Contracts\MissionRepositoryInterface;
use App\Services\Api\MissionService;
use App\Traits\RespondsWithHttpStatus;

class OfferService
{
    use RespondsWithHttpStatus;

    protected $offerRepository;
    protected $missionRepository;

    public function __construct(OfferRepositoryInterface $offerRepository,MissionRepositoryInterface $missionRepository)
    {
        $this->offerRepository = $offerRepository;
        $this->missionRepository = $missionRepository;
    }

    private function offerNotFound($offer){

        if (!$offer) {
            return $this->errorModel('Offer not found', 'Offer not found', 404, 'offer');
        }
    }

    private function userNotTheOwner($offer, $userId)
    {
        if ($offer->user_id !== $userId) {
            return $this->errorModel('Unauthorized action', 'You are not the owner of this offer', 403, 'offer');
        }
        
    }

    /** ----------------------------
     * get offers by mission ID
     * ---------------------------- */

     public function getOffersByMissionId($missionId)
    {

        $mission = $this->missionRepository->find($missionId);

        if (!$mission) {
            return $this->errorModel('Mission not found', 'Mission not found', 404, 'mission');
        }

        $offers = $this->offerRepository->getOfferByMission($mission->id);
return OffersResource::collection($offers);

        // return response()->json([
        //     'data' => OffersResource::collection($offers),
        // ]);
    }
    private function userTheOwnerAccept($offer, $userId)
    {
        if($offer->status->name_en === 'Cancelled'){
            return $this->errorModel('Offer already accepted', 'Offer already accepted', 403, 'offer');
        }
          $mission = $offer->mission;

          if (!$mission) {
            return $this->errorModel('Mission not found', 'Mission not found', 404, 'mission');
        }
        //case two if the user is the owner of the mission can accept the offer
        if ($mission->user_id === $userId) {
            // return $this->errorModel('Unauthorized action', 'Unauthorized action', 403, 'offer');
       
         $this->offerRepository->acceptOffer($offer->id);
            return response()->json(['message' => 'Offer accepted successfully'], 200);
       
        }
        return $this->errorModel('Unauthorized action Only The Owner Of Mission Can Accept Offer', 'Unauthorized action', 403, 'offer');
        
    }
    private function userTheOwnerReject($offer, $userId)
    {
                  $mission = $offer->mission;

 if ($mission->user_id === $userId) {
            $this->offerRepository->rejectOfferByClient($offer->id);
            return response()->json(['message' => 'Offer Canceled successfully'], 200);
        }
        return $this->errorModel('Unauthorized action Only The Owner Of Mission Can Accept Offer', 'Unauthorized action', 403, 'offer');
        
    }

    /** ----------------------------
     * Store a new offer
     * ---------------------------- */
    public function store(StoreOffer $request)
    {
        //check if the user is valid if the mission is critcal
     
        $status = Status::where('name_en', 'Under review')->first();

        $mission = $this->missionRepository->find($request->mission_id);

        if (!$mission) {
            return $this->errorModel('Mission not found', 'Mission not found', 404, 'mission');
        }        
        if($this->getAuthUserId()->is_valid===0 && $mission->field->is_critical===1){
            return $this->errorModel('You are not valid user', 'You are not valid user', 403, 'user');
        } 

        //check if the user who create the offer is not the owner of the mission
        if ($mission->user_id === $this->getAuthUserId()->id) {
            return $this->errorModel('Unauthorized action', 'You cannot create an offer for your own mission', 403, 'offer');
        }
            $request->merge([
                        'mission_id' => $request->mission_id,
                        'user_id' => $this->getAuthUserId()->id,
                        'status_id' => $status->id,
                    ]);

         $this->offerRepository->createOffer($request->all());
 
       
        return response()->json([
            'message' => 'Offer created successfully',
        ], 201);
    }

    /** ----------------------------
     * Get done offers (received or cancelled)
     * ---------------------------- */
    public function getDoneOffers()
    {
        $statusIds = Status::whereIn('name_en', ['received', 'Cancelled'])->pluck('id');

        return response()->json([
            'data' => OffersResource::collection(
                $this->offerRepository->getDoneOffers($statusIds)
            ),
        ]);
    }

    /** ----------------------------
     * Get current offers (accepted)
     * ---------------------------- */
    public function getCurrentOffers()
    {
        $statusIds = Status::where('name_en', 'Accepted')->pluck('id');

        return response()->json([
            'data' => OffersResource::collection(
                $this->offerRepository->getCurrentOffers($statusIds)
            ),
        ]);
    }

    /** ----------------------------
     * Get offer by ID
     * ---------------------------- */
    public function getOfferById(int $id)
    {
        $offer = $this->offerRepository->getOfferById($id);

        if (!$offer) {
            return $this->errorModel('Offer not found', 'Offer not found', 404, 'offer');
        }

        return response()->json([
            'data' => new OfferResource($offer),
        ]);
    }

    /** ----------------------------
     * Accept offer by client
     * ---------------------------- */
    public function acceptOffer($offerId)
    {

        //mission owner only one can accept  offer
        $userId = $this->getAuthUserId()->id;
        $offer = $this->offerRepository->getOfferById($offerId);

        $this->offerNotFound($offer);
        //case 1 if i freelancer and  try to accept my own offer
        $this->userNotTheOwner($offer, $userId);
        


        //check if the one who accept the offer is the owner of the mission

        //case two if the user is the owner of the mission can accept the offer
      return  $this->userTheOwnerAccept($offer, $userId);

     
        // the user is not the owner of the mission and is not the owner of the offer


    }

    /** ----------------------------
     * Reject offer by client
     * ---------------------------- */
    public function rejectOfferByClient($offerId)
    {
        $userId = $this->getAuthUserId()->id;
        $offer = $this->offerRepository->getOfferById($offerId);
      $this->offerNotFound($offer);


        //case 1 if i freelancer and  try to accept my own offer
          $this->userNotTheOwner($offer, $userId);
    //check if the one who accept the offer is the owner of the mission
    //case two if the user is the owner of the mission can CANCEL the offer
    return $this->userTheOwnerReject($offer, $userId);
       

    }

    /** ----------------------------
     * Helpers
     * ---------------------------- */
    private function getAuthUserId()
    {
        return auth()->user();
    }
}
