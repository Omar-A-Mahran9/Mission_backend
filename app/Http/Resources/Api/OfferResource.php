<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OfferResource extends JsonResource
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
            'mission_description' => $this->mission->description,
            'mission_attachment' => $this->mission->attachments->map(function ($attachment) {
                return [
                    'file' => $attachment->file,
                ];
            }),

            'mission_skills'=> $this->mission->skills->map(function ($skill) {
                return [
                    'name' => $skill->name,
                ];
            }), 

            'mission_budget'=> $this->mission->budget,
            'status'=> $this->status->name, 
            'delivery_duration'=> $this->mission->days_until_delivery . ' ' . __('days'),

'delivery_time' => Carbon::parse($this->mission->delivery_time)->diffForHumans(),

 
             // 'status' => $this->status->name,
            
        ]; 
    }
}
