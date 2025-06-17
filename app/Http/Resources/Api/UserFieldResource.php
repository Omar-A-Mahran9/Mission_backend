<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'field_id' => $this["field"],
            'specialist_ids' =>  $this["specialists"],
            'skill_ids' => SkillResource::collection( $this["skills"])
        ];
    }
}
