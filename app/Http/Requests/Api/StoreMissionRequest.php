<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreMissionRequest extends FormRequest
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
        $rules = [
            'field_id' => 'required|exists:fields,id',
            'specialist_id' => 'required|exists:specialists,id',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
            'description' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'budget' => 'required|numeric',
            // 'payment_way_id' => 'required|exists:payment_ways,id',
            'days_until_delivery' => 'required|integer|min:1',
            'available_attachment' => 'required|boolean',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,docx|max:1024'
        ];


    return $rules;

    }
}
