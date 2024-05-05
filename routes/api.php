<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TableController;

use Illuminate\Support\Facades\Route;

//login
Route::post('/login',[AccountController::class, 'login']);


//account section
Route::get('/account/all-account',[AccountController::class, 'getAllAccount']);
Route::post('/account/create-account',[AccountController::class, 'createAccount']);
Route::post('/account/update-account/{id}',[AccountController::class, 'updateAccount']);
Route::post('/account/delete-account/{id}',[AccountController::class, 'deleteAccount']);
Route::get('/account/search-account',[AccountController::class, 'searchAccount']);
Route::get('/account/find-account',[AccountController::class, 'finById']);
Route::post('/account/change-password',[AccountController::class, 'changePassword']);
Route::post('/account/check-password',[AccountController::class, 'checkPassword']);

//table section
Route::get('/table/all-table',[TableController::class, 'getAllTable']);
Route::post('/table/create-table',[TableController::class, 'createTable']);
Route::post('/table/update-table/{id}',[TableController::class, 'updateTable']);
Route::post('/table/delete-table/{id}',[TableController::class, 'deleteTable']);
Route::get('/table/search-table',[TableController::class, 'searchTable']);
Route::get('/table/find-table',[TableController::class, 'finById']);
Route::get('/table/find-table-status',[TableController::class, 'findTableByStatus']);









