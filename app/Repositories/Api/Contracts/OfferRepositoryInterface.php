<?php

namespace App\Repositories\Api\Contracts;
use Illuminate\Database\Eloquent\Builder;

interface OfferRepositoryInterface
{

    // Define methods that the OfferRepository should implement
    public function createOffer(array $data);

    public function getOfferByMission($mission_Id);
    public function getDoneOffers($status_id);
    public function getCurrentOffers($status_id);

    //with mission data
    public function getOfferById(int $id);

    public function acceptOffer(int $offerId);
    public function rejectOfferByClient(int $mission_id);

    public function filterOfferByPriceAndRate($mission_id);

        public function withUserAndRating(Builder $query, int $missionId);
    public function orderByAverageRating(Builder $query, string $direction, int $missionId);

 
 
 }
