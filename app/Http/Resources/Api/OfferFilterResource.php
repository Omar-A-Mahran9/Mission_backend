<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferFilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->id,
              'status' => $this->status->name,
           
            
            'mission_description' => $this->mission->description,
           'specialists' =>   $this->mission->specialist->name,
            // 'available_budget'=> $this->available_budget,
            


        //  'average_rating' => $this->user->average_rating, // From withAvg()
 
        ];
    }
}
