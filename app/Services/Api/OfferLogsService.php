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
        // $offer = $this->offerRepository->getOfferById($data['offer_id']);
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

        // Determine role based on who created the mission

        $data['user_id'] = $authUserId;
        $data['offer_action_at'] = now();
        $data['mission_id'] = $mission->id;
        $data['role'] = ((int) $mission->user_id === (int) $authUserId) ? 1 : 2;

        $offerLog = $this->offerLogsRepository->taskHandOver($data);
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

        $data['user_id'] = $authUserId;
        $data['offer_action_at'] = now();
        $data['mission_id'] = $mission->id;
        $data['role'] = ((int) $mission->user_id === (int) $authUserId) ? 1 : 2;

        $offerLog = $this->offerLogsRepository->taskHandOver($data);
        return response()->json([
            'data' => $offerLog,
        ], 201);
    }

}
