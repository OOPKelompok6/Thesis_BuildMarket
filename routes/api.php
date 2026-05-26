<?php

use App\Http\Controllers\Api\PaymentWebHookController;
use App\Services\ShipmentService;
use Illuminate\Support\Facades\Route;

// Payment webhook handler
Route::post('/payments/webHookHandler', [PaymentWebHookController::class, 'handle']);

//Shipment Utilities
Route::post('/shipment/getProvince', [ShipmentService::class, 'getAvailableProvince']);
Route::post('/shipment/getCity', [ShipmentService::class, 'getAvailableCity']);
Route::post('/shipment/getDistrict', [ShipmentService::class, 'getAvailableDistrict']);
Route::post('/shipment/calculateCost', [ShipmentService::class, 'getShippingCost']);