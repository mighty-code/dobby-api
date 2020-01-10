<?php

use App\Http\Controllers\Api\DialogflowWebhooksController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('webhooks', [DialogflowWebhooksController::class, 'webhooks']);
});
