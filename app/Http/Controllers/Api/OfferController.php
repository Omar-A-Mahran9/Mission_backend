<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOffer;
use App\Http\Requests\TaskHandOverRequest;
 use App\Services\Api\OfferService;
use App\Http\Requests\OfferFilterRequest;
class OfferController extends Controller
{
    protected $service;

    public function __construct(OfferService $service)
    {
        $this->service = $service;
    }

    public function store(StoreOffer $request)
    {
       return  $this->service->store($request);
 
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
    public function getOffersByMissionId(int $mission_id)
    {
        return $this->service->getOffersByMissionId($mission_id);
    }


    public function acceptOffer(int $id)
    {
        return $this->service->acceptOffer($id);
    }

    
    public function rejectOfferByClient(int $id)
    {
        return $this->service->rejectOfferByClient($id);
    }
public function filterOfferByPriceAndRate(OfferFilterRequest $request)
{
    $priceSort = $request->query('priceSort'); //  
    $missionId = $request->query('missionId'); //  
    $rate = $request->query('rate'); // Get query parameter
     
    return $this->service->filterOfferByPriceAndRate($priceSort, $missionId,$rate);
}
// public function filterByRate(\Illuminate\Http\Request $request)
// {
//     $rate = $request->query('rate'); // Get query parameter
//     $missionId = $request->query('missionId'); // Optional mission ID parameter
     
//     return $this->service->filterByRate( $missionId, $rate);
// }
    
}
