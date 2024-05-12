<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BillDetailController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
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

//category section
Route::get('/category/all-category',[CategoryController::class, 'getAllCategory']);
Route::post('/category/create-category',[CategoryController::class, 'createCategory']);
Route::post('/category/update-category/{id}',[CategoryController::class, 'updateCategory']);
Route::post('/category/delete-category/{id}',[CategoryController::class, 'deleteCategory']);
Route::get('/category/find-category',[CategoryController::class, 'finById']);
Route::get('/category/food-category',[CategoryController::class, 'getFoodByCategory']);

//food section
Route::get('/food/all-food',[FoodController::class, 'getAllFood']);
Route::post('/food/create-food',[FoodController::class, 'createFood']);
Route::post('/food/update-food/{id}',[FoodController::class, 'updateFood']);
Route::post('/food/delete-food/{id}',[FoodController::class, 'deleteFood']);
Route::get('/food/find-food',[FoodController::class, 'finById']);
Route::get('/food/search-food',[FoodController::class, 'searchFood']);






