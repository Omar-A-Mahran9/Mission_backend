<?php

namespace App\Http\Requests\Api;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePortfolioRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'description' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'files' => ['nullable', 'array', 'min:1'],
            'files.*' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048'
            ],
            'deleted_files' => ['array'],
        ];
    }
}
