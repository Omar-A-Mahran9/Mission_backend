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
use Illuminate\Validation\Rules\Password;

class ForgetPasswordController extends Controller
{
    public function sendOtp(Request $request, $phone)
    {
        $request['phone'] = $request->phone;
        $request->validate([
            'phone' => ['required', new PhoneNumber()],
        ]);
        $user = User::where('phone', 'LIKE', "%$request->phone%")->first();
        if (!$user)
            return $this->failure(__("This user does not exist"));
        if ($user->status === UserStatus::Inactive->value) {
            return $this->failure(__("Your account is blocked. Please contact support."));
        }
        UserOtp::updateOrCreate(
            ['user_id' => $user->id], // Condition to find or create the record
            ['otp' => rand(1111, 9999)] // Update the OTP value
        );
        return $this->success("Send otp is successfully", ["customer" => new UserResource($user)]);
    }

    public function changePassword(Request $request, $phone)
    {
        $request['phone'] = $request->phone;
        $request->validate([
            'phone' => ['required', new PhoneNumber()],
            'password' => ['required', Password::min(8)->max(16)->letters()->numbers()],
            'password_confirmation' => 'required|same:password',
        ]);
        $user = User::where('phone', 'LIKE', "%$request->phone%")->first();
        if (!$user)
            return $this->failure(__("This user does not exist"));
        if ($user->status === UserStatus::Inactive->value) {
            return $this->failure(__("Your account is blocked. Please contact support."));
        }
        $user->update(['password' => $request->password]);

        return $this->success("password changed successfully");
    }
}
