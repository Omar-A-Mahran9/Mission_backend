<?php

namespace App\Repositories\Api\Eloquent;

use App\Repositories\Api\Contracts\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{

    // public function login($credentials)
    // {
    //     $user = User::where('email', $credentials['email'])->first();

    //     if (!$user || !Hash::check($credentials['password'], $user->password)) {
    //         return null;
    //     }

    //     // Issue token (example using Laravel Sanctum)
    //     $token = $user->createToken('API Token')->plainTextToken;
    //     return [
    //         'user' => $user,
    //         'token' => $token,
    //     ];
    // }

    public function register($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Issue token (example using Laravel Sanctum)
        $token = $user->createToken('API Token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
