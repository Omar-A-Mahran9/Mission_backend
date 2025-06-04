<?php

namespace App\Repositories\Api\Contracts;

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
    public function rejectOfferByClient(int $offerId);

 
 
 }
