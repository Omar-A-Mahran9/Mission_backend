<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'start_price' => $this->start_price,
            // 'remaining' => Carbon::parse($this->start_time)->isToday() ? (now()->lessThan($this->start_time) ? now()->diff($this->start_time)->format('%H:%I:%S') : "00:00:00") : Carbon::parse($this->start_time)->format('d/m/Y'),
            'remaining' => Carbon::parse($this->start_time)->isToday() ? (now()->lessThan($this->start_time) ? now()->diff($this->start_time)->format('%H:%I:%S') : now()->diff($this->end_time)->format('%H:%I:%S')) : Carbon::parse($this->start_time)->format('d/m/Y'),
            'is_start' => now()->lessThan($this->start_time) ? 'yes' : 'no',
            'start_time' => Carbon::parse($this->start_time)->format('H:i:s'),
            'end_time' => Carbon::parse($this->end_time)->format('H:i:s'),
            'session_duration' => Carbon::parse($this->end_time)->diffInMinutes(Carbon::parse($this->start_time)),
            'full_image_path' => $this->images()->first()->full_image_path ?? null,
        ];
    }
}
