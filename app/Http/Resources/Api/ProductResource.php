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
            'product_price' => $this->product_price,
            'start_price' => $this->start_price,
            'ticket_price' => $this->ticket_price,
            'remaining' => Carbon::parse($this->start_time)->isToday()
                ? (now()->lessThan($this->start_time)
                    ? now()->diff($this->start_time)->format('%H:%I:%S') // Countdown to start
                    : (now()->lessThan($this->end_time)
                        ? now()->diff($this->end_time)->format('%H:%I:%S') // Countdown to end
                        : Carbon::parse($this->end_time)->format('d/m/Y H:i:s'))) // Show end time after session ends
                : Carbon::parse($this->start_time)->format('d/m/Y H:i:s'),
            'is_start' => now()->lessThan($this->start_time) ? 'yes' : 'no',
            'start_time' => Carbon::parse($this->start_time)->format('H:i:s'),
            'end_time' => Carbon::parse($this->end_time)->format('H:i:s'),
              'session_duration' => $this->end_time
                ? $this->formatDuration(Carbon::parse($this->start_time)->diff(Carbon::parse($this->end_time)))
                : 0,
            'bids_count' => $this->bids_count,
            'full_image_path' => $this->images()->first()->full_image_path ?? null,
        ];
    }
    private function formatDuration($diff)
    {
        $days = $diff->d;
        $hours = $diff->h;
        $minutes = $diff->i;
        if ($days > 0) {
            return "{$days} " . __("days") . ($hours > 0 ? " {$hours} " . __("hours") : "");
        } elseif ($hours > 0) {
            return "{$hours} " . __("hours") . ($minutes > 0 ? " {$minutes} " . __("minutes") : "");
        } else {
            return "{$minutes} " . __("minutes");
        }
    }
}
