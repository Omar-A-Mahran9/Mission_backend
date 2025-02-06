<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FloatingAuctionListResource extends JsonResource
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
            'remaining' =>  now()->diff($this->end_time)->format("%d " .__('days')." %H:%I:%S"),
            'full_image_path' => $this->images()->first()->full_image_path ?? null,
        ];
    }
}
