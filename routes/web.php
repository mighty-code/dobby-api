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

Route::redirect('/', '/home');

Route::get('/imprint', function () {
    return view('imprint');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::middleware(['notFirstLogin'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::view('/manage', 'manage')->name('manage');
        Route::view('/api/manage', 'api.manage')->name('api.manage');

        Route::get('user/connections', 'ConnectionController@myConnections');
        Route::post('user/connections', 'ConnectionController@store');
        Route::delete('user/connection/{id}', 'ConnectionController@delete');
        Route::resource('connections', 'ConnectionController');
        Route::get('connection/next', 'ConnectionController@nextConnection');
        Route::post('connection/{id}/refresh', 'ConnectionController@refreshConnection');
        Route::post('connection/{id}/default', 'ConnectionController@makeDefault');
    });

    Route::view('/onboarding', 'onboarding')->name('onboarding');
    Route::post('/onboarding', 'OnboardingController@store')->name('onboarding.store');

    Route::get('stations/search', 'StationController@search');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('admin_logs');
});
