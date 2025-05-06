<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Enums\Provider;
use App\Rules\ExistPhone;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use Illuminate\Support\Facades\Cache;
use App\Rules\PasswordNumberAndLetter;
use Illuminate\Validation\Rules\Password;
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
        $currentStep = request()->query('step', 1);
        $stepsRules = [
            [
                'first_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
                'last_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
                'phone' => ['required', new PhoneNumber(), new ExistPhone(new User(), null, false)],
                'email' => 'nullable|string|email|unique:users',
                'city_id' => ['required', 'exists:cities,id'],
                'password' => ['required', Password::min(8)->max(16)->letters()->numbers()],
                'password_confirmation' => 'required|same:password',
            ],
            [
                'otp' => ['required', 'numeric', 'digits:4', function ($attribute, $value, $fail) {
                    $cacheKey = "register:{$this->input('registration_token')}";
                    $cachedData = Cache::get($cacheKey, []);
                    if (!array_key_exists('otp', $cachedData)) {
                        return $fail(__('The OTP is not valid.'));
                    }
                    if ($cachedData['otp'] != $value) {
                        return $fail(__('The OTP is not valid.'));
                    }
                }],
                'registration_token' => ['required', 'string', new NotNumbersOnly()],
            ],
            [
                'field_id' => ['required', 'exists:fields,id'],
                'interest_id' => ['nullable', 'array'],
                'interest_id.*' => ['exists:interests,id'],
                'registration_token' => ['required', 'string', new NotNumbersOnly()],
            ],
            [
                'certificates' => ['nullable', 'array', 'min:1'],
                'certificates.*.name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
                'certificates.*.have_expiration_date' => ['required', 'boolean'],
                'certificates.*.expiration_date' => ['required_unless:certificates.*.have_expiration_date,true', 'nullable', 'date'],
                'certificates.*.files' => ['required', 'array', 'min:1'],
                'certificates.*.files.*' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png,pdf',
                    'max:2048'
                ],
                'registration_token' => ['required', 'string', new NotNumbersOnly()],
            ],
            [
                'license' => ['nullable', 'array', 'min:1'],
                'license.*.name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
                'license.*.have_expiration_date' => ['required', 'boolean'],
                'license.*.expiration_date' => ['required_unless:license.*.have_expiration_date,true', 'nullable', 'date'],
                'license.*.files' => ['required', 'array', 'min:2'],
                'license.*.files.*' => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png,pdf',
                    'max:2048'
                ],
                'registration_token' => ['required', 'string', new NotNumbersOnly()],
            ],
        ];
        return array_key_exists($currentStep, $stepsRules) ? $stepsRules[$currentStep] : [];
    }
}
