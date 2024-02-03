<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

//user
Route::post('createuser', [userController::class, 'create']);
Route::post('updateuser', [userController::class, 'update']);
Route::post('user/{id}', [userController::class, 'find']);
Route::get('users', [userController::class, 'allUsers']);

//category
Route::get('categories', [CategoryController::class, 'allCategory']);
Route::post('categories/{id}', [CategoryController::class, 'find']);
Route::post('createcategory', [CategoryController::class, 'create']);
Route::post('updatecategory/{id}', [CategoryController::class, 'update']);
Route::delete('deletecategory/{id}', [CategoryController::class, 'delete']);

// Owner
Route::get('owner', [OwnerController::class, 'allowner']);
Route::get('owner/{id}', [OwnerController::class, 'find']);
Route::post('createowner', [OwnerController::class, 'create']);
Route::post('updateowner', [OwnerController::class, 'update']);

//items
Route::get('items', [ProductController::class, 'allItem']);
Route::get('items/{id}', [ProductController::class, 'find']);
Route::post('createitem', [ProductController::class, 'create']);
Route::post('updateitem', [ProductController::class, 'update']);
