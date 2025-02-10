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
    Route::post('forget-password/{phone}', 'Auth\ForgetPasswordController@sendOtp');
    Route::post('change-password/{phone}', 'Auth\ForgetPasswordController@changePassword');

    // 🔹 Public Home Routes (Both No Auth Required, Require)
    Route::get('products', 'ProductController@index');
    Route::get('products/{product}', 'ProductController@show');

    Route::get('support', 'SupportController@supportData');
    Route::get('cities', 'AuctionController@cities');
    // 🔒 Protected Routes (Require Auth)
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', 'Auth\AuthController@logout');
        Route::post('refund/{product}', 'ProductController@refund');
        Route::post('ticket/{product}', 'ProductController@buyTicket');
        Route::get('floating/auctions', 'ProductController@floatingAuctions');
        Route::get('unpaid-wins', 'ProductController@unpaidWinningProducts');
        Route::get('profile', 'ProfileController@profile');
        Route::post('profile', 'ProfileController@updateProfile');
        Route::post('profile/password', 'ProfileController@updatePassword');
        Route::get('auctions/{product}', 'AuctionController@auction');
        Route::get('auctions', 'AuctionController@auctions');
        Route::get('ended', 'AuctionController@endedAuctions');
        // Route::get('auctions/ended', 'AuctionController@endedAuctions');
        Route::post('bid/{product}', 'AuctionController@bid');
        Route::post('pay/{product}', 'AuctionController@pay');
        Route::get('addresses', 'AddressController@addresses');
        Route::post('addresses', 'AddressController@store');
        Route::post('addresses/{address}', 'AddressController@update');
        Route::delete('addresses/{address}', 'AddressController@destroy');
        Route::get('transactions/history', 'TransactionHistoryController');
    });
});