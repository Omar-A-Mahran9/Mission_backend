<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductUnPaidWinListResource extends JsonResource
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
            'price' => $this->winner->bid->bid_amount,
            'remaining' => Carbon::now()->diffForHumans(Carbon::parse($this->winner->created_at)->addHours((int) setting('time_left_to_pay'))),
            'full_image_path' => $this->images()->first()->full_image_path ?? null,
        ];
    }
}
