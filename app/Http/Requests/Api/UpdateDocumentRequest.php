<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'have_expiration_date' => ['required', 'boolean'],
            'expiration_date' => ['required_unless:have_expiration_date,true', 'nullable', 'date'],
            'files' => ['nullable', 'array', 'min:1'],
            'files.*' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048'
            ],
            'deleted_files' => ['array'],
            'deleted_files.*' => [
                'required',
                'integer',
                'exists:document_attachments,id'
            ]
        ];
    }
}
