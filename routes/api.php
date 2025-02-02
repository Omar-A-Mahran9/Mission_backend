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
    Route::post('register', 'Auth\AuthController@register');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('resend-otp/{phone}', 'Auth\AuthController@resendOTP');
    Route::post('check-otp/{phone}', 'Auth\AuthController@checkOTP');
    Route::get('google/redirect', 'Auth\GoogleAuthController@redirectToGoogle');
    Route::get('google/callback', 'Auth\GoogleAuthController@handleGoogleCallback');
    Route::post('google/mobile', 'Auth\GoogleAuthController@googleLoginMobile');
    Route::get('resend-otp/register/{phone}', 'Auth\AuthController@resendOTP');

    Route::post('send-otp/{phone}', 'Auth\ForgetPasswordController@sendOtp');
    Route::post('check-otp/{phone}', 'Auth\ForgetPasswordController@checkOTP');
    Route::post('change-password/{phone}', 'Auth\ForgetPasswordController@changePassword');

    Route::get('products', 'ProductController@index');
    Route::get('products/{product}', 'ProductController@show');

    // Route::middleware(['auth:api'])->group(function () {
    //     Route::get('products', 'ProductController@index');
    //     Route::post('products/{product}/rate', 'ProductController@rate');
    //     Route::post('/customers/update-info', 'ProfileController@updateInfo');
    //     Route::post('/customers/update-password', 'ProfileController@updatePassword');
    //     Route::get('orders', 'OrderController@orderBy');
    //     Route::get('track-orders', 'OrderController@trackOrderLogin');

    //     // Route::get('/current', function (Request $request) {
    //     //     return auth()->user();
    //     // });
    // });
});
