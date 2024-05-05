<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

//login
Route::post('/login',[AccountController::class, 'login']);


//user section
Route::get('/account/all-account',[AccountController::class, 'getAllAccount']);
Route::post('/account/create-account',[AccountController::class, 'createAccount']);
Route::post('/account/update-account/{id}',[AccountController::class, 'updateAccount']);
Route::post('/account/delete-account/{id}',[AccountController::class, 'deleteAccount']);
Route::get('/account/search-account',[AccountController::class, 'searchAccount']);
Route::get('/account/find-account',[AccountController::class, 'finById']);
Route::post('/account/change-password',[AccountController::class, 'changePassword']);
Route::post('/account/check-password',[AccountController::class, 'checkPassword']);









