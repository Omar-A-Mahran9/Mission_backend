<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\OfferLogsService;
use App\Http\Requests\TaskHandOverRequest;
use App\Http\Resources\Api\OffersResource;

class OfferLogsController extends Controller
{
    protected $service;

    public function __construct(OfferLogsService $service)
    {
        $this->service = $service;
    }

    public function taskHandOver(TaskHandOverRequest $request)
    {
        $data = $request->validated();
        // $data['client_id'] = $request->mission->user_id; // Assuming the client is the mission owner

        return $this->service->taskHandOver($data);

    
    }
    public function cancelOffer(TaskHandOverRequest $request)
    {
        $data = $request->validated();
 
      return    $this->service->cancelOffer($data);
 
    }
    public function CloseTheOffers($id)
    {
        $offers =  $this->service->CloseTheOffers($id);
 
      return   $offers;
 
    }
}
