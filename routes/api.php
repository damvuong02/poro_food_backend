<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//user section
Route::get('/user/all-user',[UserController::class, 'getAllUser']);
Route::post('/user/create-user',[UserController::class, 'createUser']);


