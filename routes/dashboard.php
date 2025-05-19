<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('index');

/* begin Delete And restore */
Route::delete("products/delete-selected", "ProductController@deleteSelected");
Route::get("products/restore-selected", "ProductController@restoreSelected");
/* end Delete And restore */


Route::resource('users', 'UserController');
Route::put("users/{user}/document/{document}", "UserController@approve")->name('approve');
Route::get('users/{user}/certificates', "UserController@certificatesAjax")
    ->name('dashboard.users.certificates.ajax');
Route::get('users/{user}/experiences', "UserController@experiencesAjax")
    ->name('dashboard.users.experiences.ajax');
Route::get('users/{user}/licenses', "UserController@licensesAjax")
    ->name('dashboard.users.licenses.ajax');
Route::get('users/{user}/portfolios', "UserController@portfoliosAjax")
    ->name('dashboard.users.portfolios.ajax');
Route::get('users/status/{user}', 'UserController@status')->name('users.status');
Route::post('users/is-valid/{user}', 'UserController@isValid')->name('users.is-valid');
Route::resource('products', 'ProductController');
Route::get("products/{product}/images", "ProductController@images");
Route::put("delivery/{winner}", "ProductController@updateDelivery")->name('delivery');

Route::resource('promo-codes', 'PromoCodeController');

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
