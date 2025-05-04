<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
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
            'expiration_date' => $this->expiration_date,
            'have_expiration_date' => $this->have_expiration_date,
            'full_path' => $this->files->pluck('full_image_path')
        ];
    }
}
