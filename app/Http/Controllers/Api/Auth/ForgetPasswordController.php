<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\UserOtp;
use App\Enums\UserStatus;
use App\Rules\PhoneNumber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Services\Api\ForgetPasswordService;
use Illuminate\Validation\Rules\Password;

class ForgetPasswordController extends Controller
{
    protected $service;

    public function __construct(ForgetPasswordService $service)
    {
        $this->service = $service;
    }
    public function sendOtp(Request $request, $phone)
    {
        $user = $this->service->forgetPassword($request);
        if ($user['status'] == 422) {
            return $this->validationFailure(["phone" => [$user['phone']]]);
        }
        return $this->success("Send otp is successfully", ["customer" => new UserResource($user)]);
    }

    public function verifyOtp(Request $request, $phone)
    {
        $user = $this->service->verifyOtp($request, $phone);
        if ($user['status'] == 422) {
            return $this->validationFailure(["phone" => [$user['phone']]]);
        }
        return $this->success("OTP verified successfully");
    }
    public function changePassword(Request $request, $phone)
    {
        $user = $this->service->changePassword($request);
        if ($user['status'] == 422) {
            return $this->validationFailure(["phone" => [$user['phone']]]);
        }
        return $this->success("password changed successfully");
    }
}
