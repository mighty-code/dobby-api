<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;

Route::redirect('/', '/home');

Route::get('/imprint', function () {
    return view('imprint');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Auth::routes();
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['notFirstLogin'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::view('/manage', 'manage')->name('manage');
        Route::view('/api/manage', 'api.manage')->name('api.manage');
    });

    Route::view('/onboarding', 'onboarding')->name('onboarding');
});
