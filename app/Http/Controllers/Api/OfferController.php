<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOffer;
use App\Http\Requests\TaskHandOverRequest;
 use App\Services\Api\OfferService;

class OfferController extends Controller
{
    protected $service;

    public function __construct(OfferService $service)
    {
        $this->service = $service;
    }

    public function store(StoreOffer $request)
    {
         $this->service->store($request);

         return response()->json([
            'message' => 'Offer created successfully',
          ],200);
    }   

    public function getDoneOffers()
    {
       return $this->service->getDoneOffers();

       
    }
    public function getCurrentOffers()
    {
       return $this->service->getCurrentOffers();

       
    }

    public function getOfferById(int $id)
    {
        return $this->service->getOfferById($id);
    }


    public function acceptOffer(int $id)
    {
        return $this->service->acceptOffer($id);
    }

    
    public function rejectOfferByClient(int $id)
    {
        return $this->service->rejectOfferByClient($id);
    }

    
}
