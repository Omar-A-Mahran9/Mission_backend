<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('index');
Route::post('/set-theme-mode', function (Request $request) {
    $themeMode = $request->input('theme_mode', 'light'); // Default to 'light'
    Session::put('theme_mode', $themeMode);
    return response()->json(['status' => 'success']);
})->name('set-theme-mode');
