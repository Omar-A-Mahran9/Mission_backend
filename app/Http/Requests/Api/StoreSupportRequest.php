<?php

namespace App\Http\Requests\Api;

use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupportRequest extends FormRequest
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
            'name' => ['required', new NotNumbersOnly()],
            'phone' => [
                'required',
                new PhoneNumber(),
            ],
            'email' => 'nullable|string|email',
            'message' => ['required', 'min:10', 'max:1000'],
        ];
    }
}
