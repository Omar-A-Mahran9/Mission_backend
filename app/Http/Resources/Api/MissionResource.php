<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionResource extends JsonResource
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
            'description' => $this->description,
            'field' => [
                'id'=>$this->field->id,
                'name'=>$this->field->name
            ],
            'specialist' => [
                'id'=>$this->specialist->id,
                'name'=> $this->specialist->name
            ],

             'budget' => $this->budget,
            'user_id' => $this->user_id,
            'payment_way_id' => $this->payment_way_id,
            'delivery_time' => $this->delivery_time?->toDateTimeString(),
            'is_publish' => (bool) $this->is_publish,
            'city_id' => $this->city_id,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),

            // Optionally include relationships if loaded
            'field' => $this->whenLoaded('field'),
            'specialist' => $this->whenLoaded('specialist'),
            'user' => $this->whenLoaded('user'),
            'payment_way' => $this->whenLoaded('paymentWay'),
            'city' => $this->whenLoaded('city'),
        ]; }
}
