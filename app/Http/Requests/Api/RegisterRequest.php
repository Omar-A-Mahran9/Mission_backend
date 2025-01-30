<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Enums\Provider;
use App\Rules\ExistPhone;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use App\Rules\PasswordNumberAndLetter;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'phone' => ['required', new PhoneNumber(), new ExistPhone(new User(), null, false)],
            'email' => 'required|string|email|unique:users',
            'provider' => ['required', 'in:' . implode(',', array_keys(Provider::values()))],
            'password' => ['required', 'string', 'min:8', 'max:16', 'confirmed', new PasswordNumberAndLetter()],
            'password_confirmation' => 'required|same:password',
        ];
    }
}
