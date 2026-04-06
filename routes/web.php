<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

//Authentication grouping
Route::get('/register', [UserController::class, 'register']); 
Route::post('/register', [UserController::class, 'createUser']); 
Route::get('/login', [UserController::class, 'login'])->name('login'); 
Route::post('/login', [UserController::class, 'authenticateUser']);
Route::post('/logout', [UserController::class, 'logout']);

//Profile Cruds
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');
Route::get('/editProfile', [UserController::class, 'editProfile'])->middleware('auth');
Route::post('/profile', [UserController::class, 'updateProfile']);

//PaymentCruds
Route::get('/payments', [PaymentController::class, 'payments'])->middleware('auth');
Route::get('/newPayment', [PaymentController::class, 'newPayment'])->middleware('auth');
Route::put('/payments', [PaymentController::class, 'createPayment'])->middleware('auth');
Route::delete('/payments/{payment}', [PaymentController::class, 'deletePayment'])->middleware('auth');
Route::get('/editPayment/{payment}', [PaymentController::class, 'editPayment'])->middleware('auth');
Route::patch('/payments/{payment}', [PaymentController::class, 'updatePayment'])->middleware('auth');