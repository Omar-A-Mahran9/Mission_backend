<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\UserOtp;
use App\Rules\PhoneNumber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\Api\AuthService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\Api\RegisterRequest;


class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
    public function register(RegisterRequest $request)
    {
        // $data                 = $request->validated();
        // dd($data);
        $result = $this->service->register($request);
        // $user = User::create($data);
        // $token = $user->createToken('Personal access token to apis')->plainTextToken;

        return $this->success(__("registered in successfully"), $result);
    }
    public function login(LoginRequest $request)
    {
        $request->validated();
        $auth = $this->service->login($request->only(['phone', 'password']));
        // $user = User::where('phone', 'LIKE', "%$request->phone%")->first();

        // if (Hash::check($request->password, $user->password)) {
        //     $token = $user->createToken('Personal access token to apis')->plainTextToken;

        //     return $this->success("logged in successfully", ['token' => $token, "user" => new UserResource($user)]);
        // } else {
        //     return $this->validationFailure(["password" => [__("Password mismatch")]]);
        // }
    }
    public function resendOTP($token)
    {
        $token = $this->service->resendOtp($token);
        return $this->success("OTP resent sucessfully.", $token);
    }
    public function checkOTP(Request $request, $phone)
    {
        $user = User::where('phone', 'LIKE', "%$request->phone%")->first();
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
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success("logged out successfully");
    }
}
