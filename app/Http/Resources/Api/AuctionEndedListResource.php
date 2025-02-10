<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuctionEndedListResource extends JsonResource
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
            'name' => $this->name,
            'price' => $this->winners?->first()?->bid?->bid_amount,
            'user_name' => $this->winners?->first()?->user?->user_name,
            'end_time' => Carbon::parse($this->end_time)->format('Y-m-d'),
            'full_image_path' => $this->images()->first()->full_image_path ?? null,

        ];
    }
}