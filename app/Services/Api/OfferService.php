<?php

namespace App\Services\Api;

use App\Http\Requests\Api\StoreOffer;
use App\Http\Resources\Api\OffersResource;
use App\Http\Resources\Api\OfferResource;
use App\Models\Status;
use App\Repositories\Api\Contracts\OfferRepositoryInterface;
use App\Http\Requests\Api\AcceptOfferRequest;
class OfferService
{
    protected $offerRepository;

    public function __construct(OfferRepositoryInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    public function store(StoreOffer $request)
    {



        $status = Status::where('name_en', 'Under review')->first();
       
      $request->merge([
       'mission_id'=> $request->mission_id,

        'user_id' => auth()->user()->id  , // Default to 20 if not authenticated
        'status_id' => $status->id,
    ]);



        return $this->offerRepository->createOffer($request->all());
    }

    public function getDoneOffers()
    {
     $status_id = Status::whereIn('name_en', ['received', 'Cancelled'])->pluck('id');

  return response()->json([
            'data' => OffersResource::collection($this->offerRepository->getDoneOffers($status_id)),
        ], 200);
     }


     public function getCurrentOffers()
     {
         $status_id = Status::where('name_en', 'Accepted')->pluck('id');

         return response()->json([
             'data' => OffersResource::collection($this->offerRepository->getCurrentOffers($status_id)),
         ], 200);
     }


    public function getOfferById(int $id)
{
    $offer = $this->offerRepository->getOfferById($id);

    if (!$offer) {
        return response()->json(['message' => 'Offer not found'], 404);
    }

    return response()->json([
        'data' => new OfferResource($offer),
    ], 200);
}


public function acceptOffer($offerId )
{
    $userId = auth()->id();
    $offer = $this->offerRepository->getOfferById($offerId);

    if (!$offer) {
        return response()->json(['message' => 'Offer not found'], 404);
    }

    if ($offer->user_id !== $userId) {
        return response()->json(['message' => 'Unauthorized action'], 403);
    }

    $this->offerRepository->acceptOffer($offer->id, $userId );

    return response()->json(['message' => 'Offer accepted successfully'], 200);
}
 
public function rejectOfferByClient($offerId )
{
    $userId = auth()->id();
    $offer = $this->offerRepository->getOfferById($offerId);

    if (!$offer) {
        return response()->json(['message' => 'Offer not found'], 404);
    }

    if ($offer->user_id !== $userId) {
        return response()->json(['message' => 'Unauthorized action'], 403);
    }

    $this->offerRepository->rejectOfferByClient($offer->id, $userId );

    return response()->json(['message' => 'Offer Canceled successfully'], 200);
}
 



}
