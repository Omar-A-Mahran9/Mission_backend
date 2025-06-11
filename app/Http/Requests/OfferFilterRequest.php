<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferFilterRequest extends FormRequest
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
          'priceSort'=>'sometimes|in:low,high',
          'rate'=>'sometimes|in:low,top',
          'missionId'=>'required|integer|exists:missions,id',
        ];
    }
}
