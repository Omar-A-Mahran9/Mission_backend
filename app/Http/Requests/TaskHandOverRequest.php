<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskHandOverRequest extends FormRequest
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
            'offer_id' => 'required|exists:offers,id',
            'offer_status_id' => 'required|exists:status,id',
            // 'mission_id' => 'required|exists:missions,id',
         ];
    }
}
