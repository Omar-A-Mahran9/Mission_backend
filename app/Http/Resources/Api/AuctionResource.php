<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResource extends JsonResource
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
            'description' => $this->description,
            'product_price' => $this->product_price,
            'start_price' => $this->start_price,
            'bid_count' => $this->bids_count,
            'participants_count' => $this->participants_count,
            'full_image_path' => $this->images,
            'highest_rank' => HighestRankListResource::collection($this->highest_rank),
        ];
    }
}
