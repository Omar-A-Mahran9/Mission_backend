<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Rules\PhoneNumber;
use App\Rules\PasswordNumberAndLetter;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone' => [
                'required',
                new PhoneNumber(),
                function ($attribute, $value, $fail) {
                    $user = User::where('phone', 'LIKE', "%$value%")->first();
                    if (!$user) {
                        return $fail(__('The phone number does not exist'));
                    }

                    if ($user->status == 2) {
                        return $fail(__('User is not active'));
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8', 'max:16', new PasswordNumberAndLetter()],
        ];
    }
}
