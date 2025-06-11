<?php

namespace App\Services\Api;

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

         if (!$offer) {

            return $this->errorModel('offer not found', 'offer not found', 404, 'offer');
            // return response()->json(['message' => 'Failed to hand over the task'], 500);
        }

        // Get the related mission
        $mission = $offer->mission;  // assuming you have a relation set up: Offer belongsTo Mission

        if (!$mission) {
            return response()->json(['message' => 'Related mission not found'], 404);
        }


        $authUserId = auth()->id();
                // 21                 21              
            if($mission->user_id !== $authUserId &&  $offer->user_id !== $authUserId){
            return response()->json(['message' => 'You are not authorized to hand over this task'], 403); 
                }        
    

        // Determine role based on who created the mission

        $data['user_id'] = $authUserId;
        $data['offer_action_at'] = now();
        $data['mission_id'] = $mission->id;
        $data['role'] = ((int) $mission->user_id === (int) $authUserId) ? 1 : 2;
        //check if user (freelance or client) not make taskhandover twice 

  $this->offerLogsRepository->taskHandOver($data);
        return response()->json([
            'message' =>'Task handed over successfully',
        ], 201);
    }
    public function cancelOffer($data)
    {
        $offer = $this->offerRepository->getOfferById($data['offer_id']);

        if (!$offer) {
            return response()->json(['message' => 'Failed to hand over the task'], 500);
        }

        // Get the related mission
        $mission = $offer->mission;  // assuming you have a relation set up: Offer belongsTo Mission

        if (!$mission) {
            return response()->json(['message' => 'Related mission not found'], 404);
        }

        $authUserId = auth()->id();


      
        // Determine role based on who created the mission
            if($mission->user_id !== $authUserId &&  $offer->user_id !== $authUserId){
            return response()->json(['message' => 'You are not authorized to hand over this task'], 403); 
                }
         
         
         $data['user_id'] = $authUserId;
        $data['offer_action_at'] = now();
        $data['mission_id'] = $mission->id;
        $data['role'] = ((int) $mission->user_id === (int) $authUserId) ? 1 : 2;

        //check if user (freelance or client) not make taskhandover twice 
        $offerLog = $this->offerLogsRepository->taskHandOver($data);
         return response()->json([
            'message' =>'Task handed over successfully',
        ], 201);
    }




 //function to check if client cancel offer and freelance say i want to cancel it //that mean cancel
    //  if client received offer and freelance say  received it //that mean done
    //if client cancel
 public function CloseTheOffers($offerId){
    //get offer log of the client and freelance
    //if bot cancel the offer then close it
    //if both received the offer then close it
    //if client cancel the offer and freelance say im working and not finished then send to  arbitration
    //if freelance say received the offer and client  say its Not finished then send to arbitration



    $offers =   $this->offerLogsRepository->CloseTheOffers($offerId);
 return $offers;
//  dd($offers);
        //  return response()->json(['message' => 'Offer closed successfully'], 200);
        // return $this->success('Offer closed successfully', [], 200);


}
    
   
     
}
