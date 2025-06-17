<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
           use Carbon\Carbon;

class OffersByMissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
              'id'=>$this->id,
            'status' => $this->status->name,
           
            'user_name' => $this->user->first_name . ' ' .$this->user->last_name,

          'user_profile' => $this->user->image 
            ? url('storage/Images/users/' . $this->user->image)
            : url('storage/Images/users/profile.png'), // Default photo 

            'user_city' => $this->user->city->name,



            
                         'available_budget'=> $this->available_budget,


        ];
    }
}
