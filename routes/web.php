<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\BrowseItemController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\UserController as UserApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemDetailController;
use App\Http\Controllers\ItemManagementController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index']);

//Hack since API use cookie based authorization while web use session based
//Technically breaks RESTful architecture but still counts as API and semi RESTful
Route::get('/currentUser', [UserApiController::class, 'getCurrentUser']);
Route::get('/itemsManagement', [ItemController::class, 'getOwnItems']);

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

//approval groupings
Route::get('/sellerRequest', [ApprovalsController::class, 'userApproval'])->middleware('auth');
Route::post('/sellerRequest', [ApprovalsController::class, 'createApproval'])->middleware('auth');
Route::get('/approvalList', [ApprovalsController::class, 'approvalList'])->middleware('auth');
Route::post('/approvalList/{approval}', [ApprovalsController::class, 'approveApproval'])->middleware('auth');
Route::delete('/approvalList/{approval}', [ApprovalsController::class, 'deleteApproval'])->middleware('auth');

//Item groupings
Route::get('/browseItem', [BrowseItemController::class, 'browseItem']);
Route::get('/item/{item}', [ItemDetailController::class, 'itemDetail']);
Route::delete('/item/{item}', [ItemManagementController::class, 'deleteItem'])->middleware('auth');
Route::post('/postReview/{item}', [ItemDetailController::class, 'postReview'])->middleware('auth');
Route::get('/itemManagement', [ItemManagementController::class, 'browseItem'])->middleware('auth');
Route::get('/newItem', [ItemManagementController::class, 'newItem'])->name('newItem')->middleware('auth');
Route::post('/newItem', [ItemManagementController::class, 'createItem'])->middleware('auth');
Route::get('/editItem/{item}', [ItemManagementController::class, 'editItem'])->name('editItem')->middleware('auth');
Route::post('/updateItem/{item}', [ItemManagementController::class, 'updateItem'])->middleware('auth');
Route::post('/postReview/{item}', [ItemDetailController::class, 'postReview']);


// Cart groupings
Route::get('/cart', [CartController::class, 'cart'])->middleware('auth');
Route::post('/addToCart', [CartController::class, 'addToCart'])->middleware('auth');
Route::post('/updateCart', [CartController::class, 'updateCart'])->middleware('auth');
Route::delete('/cart/{cartItem}', [CartController::class, 'deleteCartItem'])->middleware('auth');
