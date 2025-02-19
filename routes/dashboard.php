<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::resource('products', 'ProductController');

/** ajax routes **/
Route::post('dropzone/validate-image', 'DropzoneController@validateImage')->name('dropzone.validate-image');

// Route::post('/set-theme-mode', function (Request $request) {
//     // $themeMode = $request->input('theme_mode', 'light'); // Default to 'light'
//     // Session::put('theme_mode', $themeMode);
//     return response()->json(['status' => 'success']);
// })->name('set-theme-mode');
Route::get('/change-theme-mode/{mode}', 'SettingController@changeThemeMode')->name('change-mode');
Route::get('/language/{lang}', function (Request $request) {
    session()->put('locale', $request->lang);
    return redirect()->back();
})->name('change-language');
