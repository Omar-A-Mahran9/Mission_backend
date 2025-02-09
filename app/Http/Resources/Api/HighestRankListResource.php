<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class  HighestRankListResource extends JsonResource
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
            'full_image_path' => $this->user->full_image_path ?? null,
            'user_name' => $this->user->user_name,
            'amount' => $this->bid_amount,
            'time_elapsed' => now()->diffForHumans($this->created_at),
        ];
    }
}