<?php

namespace App\Services\Api;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Rules\NotNumbersOnly;
use Illuminate\Support\Facades\Hash;
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
        $user = $this->authRepository->login($credentials);
        if (Hash::check($credentials['password'], $user->password)) {
            $token = $user->createToken('Personal access token to apis')->plainTextToken;
            return ["status" => 200, "token" => $token, "user" => $user];
        } else {
            return ["status" => 422, "password" => [__("Password mismatch")]];
        }
    }
    public function register($data)
    {
        $step = request()->query('step', 1);
        // step 1
        $registrationToken = $data->input('registration_token', Str::uuid());
        $dataValidated = $data->validated();
        $cacheKey = "register:{$registrationToken}";
        $cachedData = Cache::get($cacheKey, []);
        /** STEP 0: Generate OTP (only if not generated within 60 seconds) */
        if ($step == 0) {
            if (!(isset($cachedData['time']) && now()->diffInSeconds($cachedData['time']) < 60)) {
                $otp = rand(1111, 9999);
                $dataValidated['otp'] = $otp;
                $data['time'] = now()->toTimeString();
            }
        }
        if ($step == 1) {
            unset($cachedData['otp'], $cachedData['time']);
        }

        // step 3
        if ($data->has('certificates')) {
            $certificatesPath = $this->certificate($data);
            $dataValidated['certificates'] = $certificatesPath;
        }

        // step 4
        if ($data->has('license')) {
            $licensePath = $this->license($data);
            $dataValidated['license'] = $licensePath;
        }
        $newData = array_merge($cachedData, $dataValidated);
        Cache::put($cacheKey, $newData, 60 * 60);

        if ($step == 5) {
            $mergedDocument = array_merge(
                $newData['certificates'] ?? [],
                $newData['license'] ?? []
            );
            $dataUser = Arr::except($newData, ['certificates', 'license']);

            $user = $this->authRepository->register($mergedDocument, $dataUser);
            Cache::forget($cacheKey);
            return $user;
        }
        return ['registration_token' => $registrationToken, 'otp' => isset($dataValidated['otp']) ? (string)$dataValidated['otp'] : null];
    }


    public function certificate($data)
    {
        if ($data->has('certificates')) {
            $certificatesPath = [];
            foreach ($data->input('certificates') as $i => $certificate) {
                $certificate['type_id'] = 1;
                $certificatesPath[$i] = $certificate;
                if ($data->hasFile("certificates.$i.files")) {
                    foreach ($data->file("certificates.$i.files") as $file) {
                        $path = uploadImageToDirectory($file, 'documents');
                        $certificatesPath[$i]['files'][] = $path;
                    }
                }
            }
            return $certificatesPath;
        }
    }

    public function license($data)
    {
        if ($data->has('license')) {
            $licensePath = [];
            foreach ($data->input('license') as $i => $license) {
                $license['type_id'] = 2;
                $licensePath[$i] = $license;
                if ($data->hasFile("license.$i.files")) {
                    foreach ($data->file("license.$i.files") as $file) {
                        $path = uploadImageToDirectory($file, 'documents');
                        $licensePath[$i]['files'][] = $path;
                    }
                }
            }
            return $licensePath;
        }
    }

    public function resendOtp($token)
    {
        $cacheKey = "register:{$token}";
        if (Cache::has($cacheKey)) {
            $cachedData = Cache::get($cacheKey, []);
            $data = [];
            if (!(isset($cachedData['time']) && now()->diffInSeconds($cachedData['time']) < 60)) {
                $otp = rand(1111, 9999);
                $data['otp'] = $otp;
                $data['time'] = now()->toTimeString();
            }
            $newData = array_merge($cachedData, $data);

            Cache::put($cacheKey, $newData, 60 * 60);
            return ['registration_token' => $token, 'otp' => $newData['otp']];
        } else {
            return null;
        }
    }
}
