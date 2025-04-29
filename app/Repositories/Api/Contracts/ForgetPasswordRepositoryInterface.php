<?php

namespace App\Repositories\Api\Contracts;

interface  ForgetPasswordRepositoryInterface
{
    // public function forgetPassword($data);
    public function verifyOtp($phone, $otp);
    public function updateOtp($data);
    public function changePassword($user, $password);
    public function getUserByPhone($phone);
}
