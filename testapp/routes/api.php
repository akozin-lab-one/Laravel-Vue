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
Route::get('categories/{id}', [CategoryController::class, 'find']);
Route::post('createcategory', [CategoryController::class, 'create']);
Route::post('category/upload', [CategoryController::class, 'upload']);
Route::patch('updatecategory/{id}', [CategoryController::class, 'update']);
Route::delete('deletecategory/{id}', [CategoryController::class, 'delete']);

// Owner
Route::get('owner', [OwnerController::class, 'allowner']);
Route::get('owner/{id}', [OwnerController::class, 'find']);
Route::post('createowner', [OwnerController::class, 'create']);
Route::patch('updateowner/{id}', [OwnerController::class, 'update']);
Route::delete('deleteowner/{id}', [OwnerController::class, 'delete']);

//items
Route::get('items', [ProductController::class, 'allItem']);
Route::get('items/{id}', [ProductController::class, 'find']);
Route::post('createitem', [ProductController::class, 'create']);
Route::post('item/upload', [ProductController::class, 'upload']);
Route::patch('updateitem/{id}', [ProductController::class, 'update']);
Route::delete('deleteitem/{id}', [ProductController::class, 'delete']);
