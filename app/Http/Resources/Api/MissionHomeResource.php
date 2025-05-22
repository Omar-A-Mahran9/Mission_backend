<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionHomeResource extends JsonResource
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
            'field_name' => $this->field->name,
            'description' => $this->description,
            'user_name' => $this->user->full_name,
            'offers_count' => $this->offers_count,
            'created_at' => $this->created_at->locale(app()->getLocale())->diffForHumans(),
        ];
    }
}
