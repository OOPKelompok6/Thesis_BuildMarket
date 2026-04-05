<?php

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
Route::get('/payment', [UserController::class, 'profile']);