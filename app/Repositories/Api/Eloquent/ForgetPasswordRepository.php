<?php

namespace App\Repositories\Api\Eloquent;


use App\Models\User;
use App\Models\UserOtp;
use App\Models\Interest;
use Illuminate\Support\Facades\DB;
use App\Repositories\Api\Contracts\ForgetPasswordRepositoryInterface;

class ForgetPasswordRepository implements ForgetPasswordRepositoryInterface
{
    public function getUserByPhone($phone)
    {
        $user = User::where('phone', 'LIKE', "%$phone%")->first();
        return $user;
    }
    public function verifyOtp($phone, $otp)
    {
        $user = User::where('phone', 'LIKE', "%$phone%")->first();
        if (!$user) {
            return null;
        }
        $userOtp = UserOtp::where('user_id', $user->id)->first();
        if ($userOtp && $userOtp->otp == $otp) {
            return true;
        }
        return false;
    }
    public function updateOtp($userId)
    {
        return DB::transaction(function () use ($userId) {
            $userOtp = UserOtp::updateOrCreate(
                ['user_id' => $userId], // Find by user_id
                ['otp' => rand(1111, 9999)] // Update or set new OTP
            );

            return $userOtp;
        });
    }
    public function changePassword($user, $password)
    {
        $user->update(['password' => $password]);

        return Interest::get();
    }
}
