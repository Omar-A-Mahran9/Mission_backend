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

    // 🔹 Forget Password Routes
    Route::post('forget-password/{phone}', 'Auth\ForgetPasswordController@sendOtp');
    Route::post('change-password/{phone}', 'Auth\ForgetPasswordController@changePassword');

    // 🔹 Public Home Routes (Both No Auth Required, Require)
    Route::get('products', 'ProductController@index');
    Route::get('products/{product}', 'ProductController@show');

    Route::get('support', 'SupportController@supportData');
    Route::get('cities', 'CityController@index');
    Route::get('fields', 'FieldController@index');
    Route::get(' ', 'InterestController@index');
    // 🔒 Protected Routes (Require Auth)
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', 'Auth\AuthController@logout');
    });
});
