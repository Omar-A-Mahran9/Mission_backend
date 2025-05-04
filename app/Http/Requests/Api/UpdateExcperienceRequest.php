<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExcperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "field_id" => "required|exists:fields,id",
            "specialist_ids" => "required|array",
            "specialist_ids.*" => "required|exists:specialists,id",
            "skill_ids" => "required|array",
            "skill_ids.*" => "required|exists:skills,id",
        ];
    }
}
