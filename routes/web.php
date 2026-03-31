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

Route::get('/profile', [UserController::class, 'profile']);
Route::get('/profile', [UserController::class, 'editProfile']);
Route::get('/profile', [UserController::class, 'updateProfile']);