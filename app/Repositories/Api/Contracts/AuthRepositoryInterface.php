<?php

namespace App\Repositories\Api\Contracts;

interface  AuthRepositoryInterface
{
    // public function login($credentials);
    public function register($data);
}
