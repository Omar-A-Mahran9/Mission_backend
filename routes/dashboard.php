<?php

use App\Http\Controllers\Dashboard\OffersController;
use App\Http\Controllers\Dashboard\ReportsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Attributes\Group;

Route::get('/', function () {
    return view('welcome');
})->name('index');

/* begin Delete And restore */
// Route::delete("products/delete-selected", "ProductController@deleteSelected");
// Route::get("products/restore-selected", "ProductController@restoreSelected");
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
// Route::resource('products', 'ProductController');
// Route::get("products/{product}/images", "ProductController@images");
// Route::put("delivery/{winner}", "ProductController@updateDelivery")->name('delivery');

Route::resource('promo-codes', 'PromoCodeController');

/** ajax routes **/
// Route::post('dropzone/validate-image', 'DropzoneController@validateImage')->name('dropzone.validate-image');

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


 
// offers 


Route::get('/offer/{user_id}',[OffersController::class,'userOffers']);




//reportController


Route::prefix('/report')->group(function(){
Route::get('/',[ReportsController::class,'index'])->name('report.index');
Route::get('/all',[ReportsController::class,'getAllReport'])->name('report.getAllReport');
Route::get('/create/form',[ReportsController::class,'storeForm'])->name('report.create');
Route::get('/edit/form/{report}',[ReportsController::class,'edit'])->name('report.edit');
Route::post('/store',[ReportsController::class,'storeReport'])->name('report.storeReport');
Route::post('/update/{report}',[ReportsController::class,'updateReport'])->name('report.update');
Route::delete('/delete/{id}',[ReportsController::class,'delete'])->name('report.delete');


});



// 

