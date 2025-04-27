<?php

namespace App\Services\Api;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Api\Eloquent\AuthRepository;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($credentials)
    {
        // return $this->authRepository->login($credentials);
    }
    public function register($data)
    {
        $registrationToken = $data->input('registration_token', Str::uuid());
        $data = $data->validated();
        // 2. Get cached data, or empty array
        $cacheKey = "register:{$registrationToken}";
        $cachedData = Cache::get($cacheKey, []);
        if (request()->query('step', 1) == 0) {
            $otp = rand(1111, 9999);
            $data['otp'] = $otp;
        }
        if (request()->query('step', 1) == 1) {
            unset($cachedData['otp']);
        }
        // 3. Merge new validated step data
        $newData = array_merge($cachedData, $data);

        // 4. Store back in cache
        Cache::put($cacheKey, $newData, 30 * 60);
        dd($registrationToken, $newData);
        // return $this->authRepository->register($data);
        return $registrationToken;
    }
}
