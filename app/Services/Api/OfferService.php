<?php

namespace App\Services\Api;

use App\Http\Requests\Api\StoreOffer;
use App\Http\Resources\Api\OfferResource;
use App\Http\Resources\Api\OffersResource;
use App\Http\Resources\Api\OfferFilterResource;
use App\Models\Status;
use App\Repositories\Api\Contracts\OfferRepositoryInterface;
use App\Repositories\Api\Contracts\MissionRepositoryInterface;
use App\Traits\RespondsWithHttpStatus;

class OfferService
{
    use RespondsWithHttpStatus;

    private OfferRepositoryInterface $offerRepository;
    private MissionRepositoryInterface $missionRepository;

    public function __construct(
        OfferRepositoryInterface $offerRepository,
        MissionRepositoryInterface $missionRepository
    ) {
        $this->offerRepository = $offerRepository;
        $this->missionRepository = $missionRepository;
    }

    /* ==================== Public Interface ==================== */

    public function store(StoreOffer $request)
    {
        $mission = $this->missionRepository->find($request->mission_id);
        $user = $this->getAuthUser();

        $this->validateOfferCreation($mission, $user);

        $offerData = $this->prepareOfferData($request, $user);
        $this->offerRepository->createOffer($offerData);

        return $this->success('Offer created successfully', [], 201);
    }

    public function getOfferById(int $id)
    {
        $offer = $this->offerRepository->getOfferById($id);
        
        if (!$offer) {
          return   $this->errorModel('Offer not found', 'Offer not found', 404, 'offer');
        }
        
        return $this->success('Offer retrieved', new OfferResource($offer));
    }

    public function getOffersByMissionId(int $missionId)
    {
        $mission = $this->getValidMission($missionId);
        $offers = $this->offerRepository->getOfferByMission($mission->id);
        
        return OffersResource::collection($offers);
    }

    public function getDoneOffers()
    {
        $statusIds = $this->getStatusIds(['received', 'Cancelled']);
        $offers = $this->offerRepository->getDoneOffers($statusIds);
        
        return $this->success('Done offers retrieved', OffersResource::collection($offers));
    }

    public function getCurrentOffers()
    {
        $statusIds = $this->getStatusIds(['Accepted']);
        $offers = $this->offerRepository->getCurrentOffers($statusIds);
        
        return $this->success('Current offers retrieved', OffersResource::collection($offers));
    }

    public function acceptOffer(int $offerId)
    {
        $user = $this->getAuthUser();
        $offer = $this->getValidOffer($offerId);
        if (!$offer) {
          return   $this->errorModel('Offer not found', 'Offer not found', 404, 'offer');
        }
        $this->validateOfferAcceptance($offer, $user);

        $this->offerRepository->rejectOfferByClient($offer->mission_id);
        $this->offerRepository->acceptOffer($offer->id);

        return $this->success('Offer accepted successfully');
    }

    public function rejectOfferByClient(int $missionId)
    {
        $user = $this->getAuthUser();
        $mission = $this->getValidMission($missionId);

        $this->validateMissionOwnership($mission, $user);

        $this->offerRepository->rejectOfferByClient($mission);
        return $this->success('Offer canceled successfully');
    }

    public function filterOfferByPriceAndRate(?string $priceSort, int $missionId, ?string $ratingSort)
    {
        if ($priceSort !== null) {
            return $this->filterByPrice($missionId, $priceSort);
        }

        return $this->filterByRate($missionId, $ratingSort);
    }

    /* ==================== Private Methods ==================== */

    private function prepareOfferData(StoreOffer $request, $user): array
    {
        return [
            'mission_id' => $request->mission_id,
            'user_id' => $user->id,
            'status_id' => Status::where('name_en', 'Under review')->first()->id,
        ] + $request->all();
    }

    private function filterByPrice(int $missionId, string $priceSort)
    {
        $mission = $this->getValidMission($missionId);
        $direction = strtolower($priceSort) === 'low' ? 'asc' : 'desc';

        $offers = $this->offerRepository->filterOfferByPriceAndRate($mission->id)
            ->orderBy('available_budget', $direction)
            ->get();

        return $this->success('Offers filtered by price ', OfferFilterResource::collection($offers));
    }

    private function filterByRate(int $missionId, ?string $ratingSort)
{
    $mission = $this->getValidMission($missionId);
    $query = $this->offerRepository->filterOfferByPriceAndRate($mission->id);
    
    // Apply the relationship loading
    $query = $this->offerRepository->withUserAndRating($query, $mission->id);

    if ($ratingSort) {
        $direction = strtolower($ratingSort) === 'top' ? 'desc' : 'asc';
        $query = $this->offerRepository->orderByAverageRating($query, $direction, $mission->id);
    }

    return $this->success(
        'Offers filtered by rating', 
        OfferFilterResource::collection($query->get())
    );
}

    /* ==================== Validation Methods ==================== */

    private function validateOfferCreation($mission, $user)
    {
        if (!$mission) {
            $this->errorModel('Mission not found', 'Mission not found', 404, 'mission');
        }

        if ($user->is_valid === 0 && $mission->field->is_critical === 1) {
            $this->errorModel('You are not valid user', 'You are not valid user', 403, 'user');
        }

        if ($mission->user_id === $user->id) {
            $this->errorModel(
                'Unauthorized action',
                'You cannot create an offer for your own mission',
                403,
                'offer'
            );
        }
    }

    private function validateOfferAcceptance($offer, $user)
    {
        if ($offer->user_id === $user->id) {
            $this->errorModel(
                'Unauthorized action',
                'You are not the owner of this offer',
                403,
                'offer'
            );
        }

        if ($offer->status->name_en === 'Cancelled') {
            $this->errorModel(
                'Offer already accepted',
                'Offer already accepted',
                403,
                'offer'
            );
        }

        $this->validateMissionOwnership($offer->mission, $user);
    }

    private function validateMissionOwnership($mission, $user)
    {
        if ($mission->user_id !== $user->id) {
            $this->errorModel(
                'Unauthorized action Only The Owner Of Mission Can Accept Offer',
                'Unauthorized action',
                403,
                'offer'
            );
        }
    }

    /* ==================== Utility Methods ==================== */

    private function getValidOffer(int $id)
    {
        $offer = $this->offerRepository->getOfferById($id);

        return $offer;
    }


    public function offerNotFound($offer){
          if (!$offer) {
          return   $this->errorModel('Offer not found', 'Offer not found', 404, 'offer');
        }
    }
    private function getValidMission(int $id)
    {
        $mission = $this->missionRepository->find($id);
        if (!$mission) {
            $this->errorModel('Mission not found', 'Mission not found', 404, 'mission');
        }
        return $mission;
    }

    private function getStatusIds(array $statusNames): array
    {
        return Status::whereIn('name_en', $statusNames)->pluck('id')->toArray();
    }

    private function getAuthUser()
    {
        return auth()->user();
    }
}