<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\UserOtp;
use App\Rules\PhoneNumber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\Api\RegisterRequest;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data                 = $request->validated();
        $user = User::create($data);
        // $user->otp()->create([
        //     'otp' => rand(1111, 9999), // Generate a random 4-digit OTP
        // ]);
        $token = $user->createToken('Personal access token to apis')->plainTextToken;

        return $this->success(__("registered in successfully"), ['token' => $token, "customer" => new UserResource($user)]);
    }

    public function resendOTP(Request $request, $mobile)
    {
        $phoneNormalized = Str::startsWith($request->phone, '0') ? ltrim($request->phone, '0') : '0' . $request->phone;
        $user = User::with('otp')->wherePhone($phoneNormalized)->orWhere('phone', $request->phone)->first();
        $request['phone'] = $user->phone ?? $request->phone;
        if (!$user) {
            $existsUser = 'exists:users';
        }
        $request->validate([
            'phone' => ['required', new PhoneNumber(), $existsUser ?? null],
        ]);
        UserOtp::updateOrCreate(
            ['user_id' => $user->id], // Condition to find or create the record
            ['otp' => rand(1111, 9999)] // Update the OTP value
        );
        // $user->otp()->updateOrCreate(['otp' => rand(1111, 9999)]);
        return $this->success("OTP resent successfully.", ["user" => new UserResource($user)]);
    }
    public function checkOTP(Request $request, $phone)
    {
        $phoneNormalized = Str::startsWith($phone, '0') ? ltrim($phone, '0') : '0' . $request->phone;
        $user = User::wherePhone($phoneNormalized)->orWhere('phone', $request->phone)->first();
        if (!$user)
            return $this->failure(__("This user does not exist"));

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
        return $this->success("verified successfully", new UserResource($user));
    }
}
