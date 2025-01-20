<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Handle Google callback for web login
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Find or create the user
            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(uniqid()), // Set a random password for social users
                ]
            );

            // Generate API token for the user
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to authenticate with Google'], 500);
        }
    }

    // Google Login for Mobile (using access token)
    public function googleLoginMobile(Request $request)
    {
        $request->validate([
            'id_token' => 'required',
        ]);

        try {
            $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->id_token);

            // Find or create the user
            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(uniqid()), // Set a random password for social users
                ]
            );

            // Generate API token for the user
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid Google token'], 500);
        }
    }
}
