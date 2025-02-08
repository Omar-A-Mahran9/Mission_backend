<?php

namespace App\Http\Requests\Api;

use App\Rules\MatchOldPassword;
use App\Rules\ValidateOldPassword;
use App\Rules\PasswordNumberAndLetter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
        // dd(request()->all());
        return [
            'current_password' => ['required', Password::min(8)->max(16)->letters()->numbers(), 'current_password'],
            'password' => ['required', Password::min(8)->max(16)->letters()->numbers()],
            'password_confirmation' => 'required|same:password',
        ];
    }
}