<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
    // return view('welcome');
});

Route::group(['namespace' => 'Dashboard\Auth', 'middleware' => 'set_locale'], function () {

    // admin login routes
    Route::get('admin/login', 'AdminAuthController@showLoginForm')->name('admin.login-form');
    Route::post('admin/login', 'AdminAuthController@login')->name('admin.login');
    Route::post('admin/logout', 'AdminAuthController@logout')->name('admin.logout');
});
