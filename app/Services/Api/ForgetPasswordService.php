<?php

namespace App\Services\Api;

use App\Enums\UserStatus;
use App\Rules\PhoneNumber;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rules\Password;
use App\Repositories\Api\Eloquent\ForgetPasswordRepository;

class ForgetPasswordService
{
    protected $forgetPasswordRepository;

    public function __construct(ForgetPasswordRepository $forgetPasswordRepository)
    {
        $this->forgetPasswordRepository = $forgetPasswordRepository;
    }
    /**
     * Handle the forget password request.
     *
     * @param array $data
     * @return mixed
     */
    public function forgetPassword($request)
    {
        $request['phone'] = $request->phone;
        $request->validate([
            'phone' => ['required', new PhoneNumber()],
        ]);
        $user = $this->forgetPasswordRepository->getUserByPhone($request->phone);
        if (!$user)
            return ["status" => 422, "phone" => __("This user does not exist")];
        if ($user->status === UserStatus::Inactive->value) {
            return ["status" => 422, "phone" => __("Your account is blocked. Please contact support.")];
        }
        $this->forgetPasswordRepository->updateOtp($user->id);
        return $user;
    }
    /**
     * Handle the OTP verification request.
     *
     * @param array $data
     * @return mixed
     */
    public function verifyOtp($request, $phone)
    {
        $user = $this->forgetPasswordRepository->getUserByPhone($phone);
        if (!$user)
            return ["status" => 422, "phone" => __("This user does not exist")];
        $request->validate([
            'otp' => [
                'required',
                Rule::exists('user_otps')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ]
        ]);
        DB::transaction(function () use ($user) {
            $user->update([
                'verified_at' => now(),
            ]);
            // Delete the OTP entry
            $user->otp()->delete();
        });
        return $user;
    }
    public function changePassword($request)
    {
        $request['phone'] = $request->phone;
        $request->validate([
            'phone' => ['required', new PhoneNumber()],
            'password' => ['required', Password::min(8)->max(16)->letters()->numbers()],
            'password_confirmation' => 'required|same:password',
        ]);
        $user = $this->forgetPasswordRepository->getUserByPhone($request->phone);
        if (!$user)
            return ["status" => 422, "phone" => __("This user does not exist")];
        if ($user->status === UserStatus::Inactive->value) {
            return ["status" => 422, "phone" => __("Your account is blocked. Please contact support.")];
        }
        return $this->forgetPasswordRepository->changePassword($user, $request->password);
    }
}
