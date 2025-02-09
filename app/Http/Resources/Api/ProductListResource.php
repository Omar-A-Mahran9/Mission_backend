<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'remaining' => Carbon::parse($this->start_time)->isToday()
                ? (now()->lessThan($this->start_time)
                    ? now()->diff($this->start_time)->format('%H:%I:%S') // Countdown to start
                    : (now()->lessThan($this->end_time)
                        ? now()->diff($this->end_time)->format('%H:%I:%S') // Countdown to end
                        : Carbon::parse($this->end_time)->format('d/m/Y H:i:s'))) // Show end time after session ends
                : Carbon::parse($this->start_time)->format('d/m/Y H:i:s'),
            'start_time' => Carbon::parse($this->start_time)->isToday() ? now()->diff($this->start_time)->format('%H:%I:%S') : Carbon::parse($this->start_time)->format('d/m/Y H:i:s'),
            // 'has_ticket' => $user ? $this->tickets()->where('user_id', $user->id)->exists() : false,
            'is_start' => now()->lessThan($this->start_time) ? 'no' : 'yes',
            'tickets_count' => $this->refunded_tickets_count,
            'full_image_path' => $this->images()->first()->full_image_path ?? null,
        ];
    }
}
