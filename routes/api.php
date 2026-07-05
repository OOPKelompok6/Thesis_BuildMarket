<?php

use App\Http\Controllers\Api\PaymentWebHookController;
use App\Http\Controllers\Api\ShipmentController;
use Illuminate\Support\Facades\Route;

// Payment webhook handler
Route::post('/payments/webHookHandler', [PaymentWebHookController::class, 'handle']);

//Shipment Utilities
Route::post('/shipment/getProvince', [ShipmentController::class, 'getAvailableProvince']);
Route::post('/shipment/getCity', [ShipmentController::class, 'getAvailableCity']);
Route::post('/shipment/getDistrict', [ShipmentController::class, 'getAvailableDistrict']);
Route::post('/shipment/calculateCost', [ShipmentController::class, 'getShippingCost']);