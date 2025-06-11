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
            'user_name' => $this->user->first_name . ' ' .$this->user->last_name,
            'user_city' => $this->user->city->name,
            'available_budget'=> $this->available_budget,
         
            


                    'average_rating' => $this->user->average_rating, // From withAvg()
         'user_id' => $this->user->id,

        ];
    }
}
