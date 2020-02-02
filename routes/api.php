<?php

use App\Http\Controllers\Api\ConnectionController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('/user', UserProfileController::class);

    Route::get('connections/next', [ConnectionController::class, 'nextConnection']);
    Route::get('connections/timetable', [ConnectionController::class, 'timetable']);
});
