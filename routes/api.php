<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RouleclinetController;
use App\Http\Controllers\CategoryController;

Route::post('/v1/login', [AuthController::class , 'login']);
Route::post('/v1/register', [AuthController::class , 'register']);
Route::post('/v1/role_store', [RoleController::class , 'role_store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/roule_client', [RouleclinetController::class , 'roule_client']);
});

// group products
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/category/index_category',[CategoryController::class, 'index_category']);
    Route::post('/v1/category/store_category', [CategoryController::class, 'store_category']);
    Route::get('/v1/category/edit_category/{category_id}', [CategoryController::class, 'edit_category']);
    Route::put('/v1/category/update_category/{category_id}',[CategoryController::class, 'update_category']);
    Route::delete('/v1/category/destroy_category/{category_id}', [CategoryController::class, 'destroy_category']);
});
