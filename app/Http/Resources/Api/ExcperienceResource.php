<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExcperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'field' => new FieldResource($this->field),
            'skills' => SkillResource::collection($this->skills),
            'specialists' => SpecialistResource::collection($this->specialists),
        ];
    }
}
