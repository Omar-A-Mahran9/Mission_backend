<?php

use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OfferLogsController;
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
    Route::get('resend-otp/{token}', 'Auth\AuthController@resendOTP');

    // 🔹 Forget Password Routes
    Route::post('forget-password/{phone}', 'Auth\ForgetPasswordController@sendOtp');
    Route::post('check-otp/{phone}', 'Auth\ForgetPasswordController@verifyOtp');
    Route::post('change-password/{phone}', 'Auth\ForgetPasswordController@changePassword');

    // 🔹 Public Home Routes (Both No Auth Required, Require)
    // Route::get('products', 'ProductController@index');
    // Route::get('products/{product}', 'ProductController@show');

    Route::get('support', 'SupportController@supportData');
    Route::get('cities', 'CityController@index');
    Route::get('fields', 'FieldController@index');
    Route::get('interests', 'InterestController@index');
    Route::get('faqs', 'FaqController@index');
    Route::get('tips', 'TipController@index');

    Route::get('support', 'SupportMessageController@index');
    Route::post('support', 'SupportMessageController@store');
    Route::get('skills', 'ExcperiencController@skills');
    Route::get('specialists/{specialist}', 'ExcperiencController@specialists');



    // 🔒 Protected Routes (Require Auth)
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', 'Auth\AuthController@logout');
    // Route::resource('offers', 'OfferController');


    //offers modules
        Route::post('/offers',[OfferController::class, 'store']);
        Route::get('/done-offer',[OfferController::class, 'getDoneOffers']);
        Route::get('/current-offer',[OfferController::class, 'getCurrentOffers']);
        Route::get('/offer/{id}',[OfferController::class, 'getOfferById']);
        Route::post('/accept-offer/{id}',[OfferController::class, 'acceptOffer']);
        Route::post('/reject-offer/{id}',[OfferController::class, 'rejectOfferByClient']);

        Route::post('/task-hand-over',[OfferLogsController::class, 'taskHandOver']);
        Route::post('/offer-cancel',[OfferLogsController::class, 'cancelOffer']);

        // 🔒 User Profile Routes
        Route::get('profile/steps', 'ProfileController@stepsStatus');
        Route::get('over-view', 'ProfileController@overView');
        Route::post('over-view', 'ProfileController@update');
        Route::apiResource('experiences', 'ExcperiencController');
        Route::apiResource('certificates', 'CertificateController');
        Route::apiResource('license', 'CertificateController');
        Route::apiResource('missions', MissionController::class);


        Route::post('certificates/{id}/update', 'CertificateController@update');
        Route::apiResource('licenses', 'LicenseController');
        Route::post('licenses/{id}/update', 'LicenseController@update');
        Route::apiResource('portfolios', 'PortfolioController');
        Route::post('portfolios/{id}/update', 'PortfolioController@update');
        Route::apiResource('promo-codes', 'PromoCodeController');
        Route::get('fieldSkills', 'FieldController@fieldSkills');
        Route::post('fieldSkills', 'FieldController@update');
        Route::apiResource('banners', 'BannerController');
        Route::get('home', 'HomeController@index');
        Route::get('home/search', 'HomeController@search');
        Route::get('home/go-search', 'HomeController@goTosearch');




    });
});
