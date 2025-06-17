<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalResource extends JsonResource
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
            'name' => $this->full_name,
            'full_image_path' => $this->full_image_path,
            'short_description' => $this->short_description,
            'average_rating' => $this->average_rating,
            'specialist' => $this->specialists?->first()?->name,
        ];
    }
}
