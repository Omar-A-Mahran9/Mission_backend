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

            'budget' => $this->budget,
            'delivery_time' => $this->delivery_time?->toDateTimeString(),
            'is_publish' => (bool) $this->is_publish,
            'city' => $this->whenLoaded('city', fn () => [
                    'id' => $this->city->id,
                    'name' => $this->city->name,
                ]),

            // Optionally include relationships if loaded
            'field' => $this->whenLoaded('field', fn () => [
                    'id' => $this->field->id,
                    'name' => $this->field->name,
                ]),

            'specialist' => $this->whenLoaded('specialist', fn () => [
                'id' => $this->specialist->id,
                'name' => $this->specialist->name,
            ]),

            'user' => $this->whenLoaded('user', fn () => [
                'id' => $this->user->id,
                'name' => $this->user->first_name . ' '. $this->user->last_name ,
            ]),

            'payment_way' => $this->whenLoaded('paymentWay', fn () => [
                'id' => $this->paymentWay->id,
                'name' => $this->paymentWay->name,
            ]),

             // Last status
            'last_statue' => $this->whenLoaded('lastStatue', fn () => [

                    'id' => $this->lastStatue->status->id,
                    'name' => $this->lastStatue->status->name,

            ]),
        ]; }
}
