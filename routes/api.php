<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//user section
Route::get('/user/all-user',[UserController::class, 'getAllUser']);
Route::post('/user/create-user',[UserController::class, 'createUser'])->middleware('auth:sanctum');
Route::post('/user/update-user/{id}',[UserController::class, 'updateUser'])->middleware('auth:sanctum');
Route::post('/user/delete-user/{id}',[UserController::class, 'deleteUser'])->middleware('auth:sanctum');
Route::get('/user/search-user',[UserController::class, 'searchUser']);






