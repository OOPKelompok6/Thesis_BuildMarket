<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\PaymentWebHookController;
use Illuminate\Support\Facades\Route;

Route::get('/items', [ItemController::class, 'getItems']);

// Payment webhook handler
Route::post('/payments/webHookHandler', [PaymentWebHookController::class, 'handle']);