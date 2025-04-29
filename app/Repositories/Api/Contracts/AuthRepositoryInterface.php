<?php

namespace App\Repositories\Api\Contracts;

interface  AuthRepositoryInterface
{
    public function login($credentials);
    public function register($document = null, $data);
    // public function verify($data);
    public function resendOtp($data);
}
