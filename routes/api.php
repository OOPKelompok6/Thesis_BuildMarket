<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\PaymentWebHookController;
use Illuminate\Support\Facades\Route;

// Payment webhook handler
Route::post('/payments/webHookHandler', [PaymentWebHookController::class, 'handle']);