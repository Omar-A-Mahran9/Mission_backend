<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
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
            'status' => $this->lastStatue && $this->lastStatue->status
                ? [
                    'id' => $this->lastStatue->status->id,
                    'name' => $this->lastStatue->status->name,
                    'color' => $this->lastStatue->status->color,
                ]
                : null,
            'budget' => $this->budget,
            'delivery_duration' => $this->days_until_delivery . ' days',

    'delivery_time' => $this->delivery_time
            ? Carbon::parse($this->delivery_time)->diffForHumans()
            : null,
            // 'is_publish' => (bool) $this->is_publish,
            'city' => $this->whenLoaded('city', fn () => [
                    'id' => $this->city->id,
                    'name' => $this->city->name,
                ]),
                'available_attachment'=>$this->available_attachment,
            // Skills - include the skills if loaded
            'skills' => $this->whenLoaded('skills', fn () => $this->skills->map(fn($skill) => [
                'id' => $skill->id,
                'name' => $skill->name,
            ])),
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
                'image'=>$this->full_image_path,
            ]),

            'payment_way' => $this->whenLoaded('paymentWay', fn () => [
                'id' => $this->paymentWay->id,
                'name' => $this->paymentWay->name,
            ]),

             'attachments' => $this->whenLoaded('attachments', fn () => $this->attachments->map(fn($attachment) => [
                'id' => $attachment->id,
                'file' => $attachment->full_path,
            ])),

        'publish_at' => $this->created_at
            ? Carbon::parse($this->created_at)->diffForHumans()
            : null,
            'offers_count'=>$this->offers->count(),

        ]; }
}
