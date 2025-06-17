<?php

namespace App\Services\Api;

use App\Models\Status;
use App\Repositories\Api\Contracts\OfferLogsRepositoryInterface;
use App\Repositories\Api\Contracts\OfferRepositoryInterface;
use App\Traits\RespondsWithHttpStatus;
class OfferLogsService
{

    use RespondsWithHttpStatus;
    protected $offerLogsRepository;
    protected $offerRepository;

    public function __construct(OfferLogsRepositoryInterface $offerLogsRepository, OfferRepositoryInterface $offerRepository)
    {
        $this->offerLogsRepository = $offerLogsRepository;
        $this->offerRepository = $offerRepository;

    }

    public function taskHandOver($data)
    {
        $offer = $this->offerLogsRepository->userOfferLogs($data['offer_id']);
        $authUserId = auth()->id();

        $isUserChangeOfferStatus = $this->offerLogsRepository->isUserChangeOfferStatus($data['offer_id'],$authUserId);
         if ($isUserChangeOfferStatus) {
            return $this->errorModel('You Change The Status Before', 'You Change The Status Before', 404, 'offer');
        }


        if (!$offer) {

            return $this->errorModel('offer not found', 'offer not found', 404, 'offer');
            // return response()->json(['message' => 'Failed to hand over the task'], 500);
        }

        // Get the related mission
        $mission = $offer->mission;  // assuming you have a relation set up: Offer belongsTo Mission

        if (!$mission) {
            return response()->json(['message' => 'Related mission not found'], 404);
        }


        // 21                 21              
        if ($mission->user_id !== $authUserId && $offer->user_id !== $authUserId) {
            return response()->json(['message' => 'You are not authorized to hand over this task'], 403);
        }


        // Determine role based on who created the mission
        $statusRecive = Status::where('name_en','received')->first()->id;
        $data['user_id'] = $authUserId;
        $data['offer_action_at'] = now();
        $data['offer_status_id'] =$statusRecive;
        
        $data['mission_id'] = $mission->id;
        $data['role'] = ((int) $mission->user_id === (int) $authUserId) ? 1 : 2;
        //check if user (freelance or client) not make taskhandover twice 

        $this->offerLogsRepository->taskHandOver($data);

           $allOfferLogs = $this->offerLogsRepository->userOfferLogsById($data['offer_id']);
        if($allOfferLogs->count() === 2) {
            // If both client and freelancer have logged their actions, close the offer
            $this->CloseTheOffers($data['offer_id']);
        }  
        return response()->json([
            'message' => 'Task handed over successfully',
        ], 201);
    }
    public function cancelOffer($data)
    {


        $offer = $this->offerRepository->getOfferById($data['offer_id']);
     
     
        
        $authUserId = auth()->id();
     
     
        $userOfferLog = $this->offerLogsRepository->isUserChangeOfferStatus($data['offer_id'],$authUserId);
        if ($userOfferLog) {
            return $this->errorModel('You Change The Status Before', 'You Change The Status Before', 404, 'offer');
        }
        if (!$offer) {
            return response()->json(['message' => 'Failed to hand over the task'], 500);
        }

        // Get the related mission
        $mission = $offer->mission;  // assuming you have a relation set up: Offer belongsTo Mission

        if (!$mission) {
            return response()->json(['message' => 'Related mission not found'], 404);
        }




        // Determine role based on who created the mission
        if ($mission->user_id !== $authUserId && $offer->user_id !== $authUserId) {
            return response()->json(['message' => 'You are not authorized to hand over this task'], 403);
        }

        $statusCancel = Status::where('name_en','Cancelled')->first()->id;
        $data['offer_status_id'] =$statusCancel;
        $data['cancel_reason'] = $data['cancel_reason'] ?? null; // Optional field, can be null

        $data['user_id'] = $authUserId;
        $data['offer_action_at'] = now();
        $data['mission_id'] = $mission->id;
        //check if the user is the owner of mission or the offer
        $data['role'] = ((int) $mission->user_id === (int) $authUserId) ? 1 : 2;

        //check if user (freelance or client) not make taskhandover twice 
         $this->offerLogsRepository->taskHandOver($data);


           $allOfferLogs = $this->offerLogsRepository->userOfferLogsById($data['offer_id']);
           
           if($allOfferLogs->count() >= 2) {
               // If both client and freelancer have logged their actions, close the offer
                return   $this->CloseTheOffers($data['offer_id']);

           
        }  

        return response()->json([
            'message' => 'Task handed over successfully',
        ], 201);
    }




    //function to check if client cancel offer and freelance say i want to cancel it //that mean cancel
    //  if client received offer and freelance say  received it //that mean done
    //if client cancel
    private function CloseTheOffers($offerId)
    {

        $offerLogs = $this->offerLogsRepository->userOfferLogsById($offerId);
        $clientStatus = null;
        $freelancerStatus = null;

        foreach ($offerLogs as $log) {
            if ($log->role == 1) {  // adjust this condition based on your data
                $clientStatus = $log->offer_status_id;
            } elseif ($log->role == 2) {
                $freelancerStatus = $log->offer_status_id;
            }
        }

       
        
        
        
        if ($clientStatus !== $freelancerStatus) {

            return response()->json(['message' => 'offer will not be close becuse client and freelancer have different statuses'], 200);
            //craete report to arbitration

        }
        $receivedStatus = Status::where('name_en', 'received')->first()->id;
        $cancelledStatus = Status::where('name_en', 'Cancelled')->first()->id;

        if ($clientStatus && $freelancerStatus == $receivedStatus) {


            return $this->offerLogsRepository->CloseTheOffers($offerId, $receivedStatus);


        }
        if ($clientStatus && $freelancerStatus == $cancelledStatus) {


            return $this->offerLogsRepository->CloseTheOffers($offerId, $cancelledStatus);


        }
        return $this->success('Offer closed successfully', [], 200);


    }



}
