<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserFieldRequest extends FormRequest
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
            "field_id" => ['required', 'integer', 'exists:fields,id'],
            "specialist_ids" => ['required', 'array'],
            "specialist_ids.*" => ['integer', 'exists:specialists,id'],
            "skill_ids" => ['required', 'array'],
            "skill_ids.*" => ['integer', 'exists:skills,id'],
        ];
    }
}
