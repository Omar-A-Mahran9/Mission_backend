<?php

namespace App\Http\Controllers\Api;

use App\Models\UserOtp;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Requests\Api\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return $this->success("Successfully", new UserResource($user));
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        if ($user->email != $data['email']) {
            $otp = rand(1111, 9999);
            UserOtp::updateOrCreate(
                ['user_id' => $user->id], // Condition to find or create the record
                ['otp' => $otp] // Update the OTP value
            );
            $cacheData = Arr::except($data, ['image']);
            // Store OTP and profile data in cache (valid for 5 minutes)
            Cache::put("profile_update_{$user->id}", $cacheData);
        } else {
            DB::transaction(function () use ($user, $data, $request) {
                if ($request->has('image'))
                    $data['image'] = updateModelImage($user, $request->file('image'), "Users");
                $user->update($data);
            });
        }
        return $this->success("Successfully", new UserResource($user));
    }

    public function checkOtpAndUpdateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'otp' => [
                'required',
                Rule::exists('user_otps')->where(function ($query) use ($user) {
                    return $query->where('user_id', $user->id);
                })
            ]
        ]);
        $profileData = Cache::get("profile_update_{$user->id}");
        DB::transaction(function () use ($user, $profileData) {
            $user->update($profileData);
            $user->otp()->delete();
        });
        Cache::forget("profile_update_{$user->id}");
        return $this->success("Successfully", new UserResource($user));
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data['password'] = $request->validated()['password'];
        auth()->user()->update($data);
        return $this->success("Updated Successfully", []);
    }
}
