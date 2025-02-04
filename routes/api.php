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

    // 🔹 Public Product Routes (No Auth Required)
    Route::get('products', 'ProductController@index');
    Route::get('products/{product}', 'ProductController@show');

    // 🔒 Protected Routes (Require Auth)
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('refund/{product}', 'ProductController@refund');
        Route::post('ticket/{product}', 'ProductController@buyTicket');
        // // Authenticated Product Routes
        // Route::get('products', 'ProductController@index'); // Authenticated users get same products
        // Route::get('products/{product}', 'ProductController@show');

        // 🔹 Add more authenticated routes here
    });
});
