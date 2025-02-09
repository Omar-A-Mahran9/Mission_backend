<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['cors', 'json.response']], function () {

    // 🔹 Public Authentication Routes (No Auth Required)
    Route::post('register', 'Auth\AuthController@register');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('resend-otp/{phone}', 'Auth\AuthController@resendOTP');
    Route::post('check-otp/{phone}', 'Auth\AuthController@checkOTP');

    // 🔹 Google Authentication
    Route::get('google/redirect', 'Auth\GoogleAuthController@redirectToGoogle');
    Route::get('google/callback', 'Auth\GoogleAuthController@handleGoogleCallback');
    Route::post('google/mobile', 'Auth\GoogleAuthController@googleLoginMobile');

    // 🔹 Forget Password Routes
    Route::post('send-otp/{phone}', 'Auth\ForgetPasswordController@sendOtp');
    Route::post('check-otp/{phone}', 'Auth\ForgetPasswordController@checkOTP');
    Route::post('change-password/{phone}', 'Auth\ForgetPasswordController@changePassword');

    // 🔹 Public Home Routes (Both No Auth Required, Require)
    Route::get('products', 'ProductController@index');
    Route::get('products/{product}', 'ProductController@show');

    Route::get('support', 'SupportController@supportData');
    // 🔒 Protected Routes (Require Auth)
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('refund/{product}', 'ProductController@refund');
        Route::post('ticket/{product}', 'ProductController@buyTicket');
        Route::get('auctions', 'ProductController@floatingAuctions');
        Route::get('auctions/products', 'ProductController@auctions');
        Route::get('unpaid-wins', 'ProductController@unpaidWinningProducts');
        Route::get('profile', 'ProfileController@profile');
        Route::post('profile', 'ProfileController@updateProfile');
        Route::post('profile/password', 'ProfileController@updatePassword');
        // // Authenticated Product Routes

        // 🔹 Add more authenticated routes here
    });
});
