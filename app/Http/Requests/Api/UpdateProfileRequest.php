<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Rules\ExistPhone;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'user_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            // 'phone' => ['required', new PhoneNumber(), new ExistPhone(new User(), auth()->user()->id, false)],
            'email' => 'required|string|email|unique:users',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
