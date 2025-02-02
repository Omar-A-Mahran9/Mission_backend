<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
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
            'start_price' => $this->start_price,
            'start_time' => Carbon::parse($this->start_time)->isToday() ? now()->diff($this->start_time)->format('%H:%I:%S') : Carbon::parse($this->start_time)->format('d/m/Y'),
            'tickets_count' => $this->tickets_count,
            'full_image_path' => $this->images()->first()->full_image_path??null,
        ];
    }
}
