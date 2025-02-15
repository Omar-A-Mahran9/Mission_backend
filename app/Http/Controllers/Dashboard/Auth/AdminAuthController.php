<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdminAuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['logout']),
            new Middleware('guest:admin', except: ['logout']),
        ];
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'   => 'required|email|exists:admins',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt($credentials, $request->has('remember_me'))) {

            $request->session()->regenerate();
            return response(['url' => redirect()->intended('/dashboard')->getTargetUrl()]);
        } else {

            throw ValidationException::withMessages([
                "password" => __("The password is incorrect"),
            ]);
        }

        return back()->withInput($request->only('email', 'remember'));
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
