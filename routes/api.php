<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RouleclinetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::post('/v1/login', [AuthController::class , 'login']);
Route::post('/v1/register', [AuthController::class , 'register']);
Route::post('/v1/role_store', [RoleController::class , 'role_store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/roule_client', [RouleclinetController::class , 'roule_client']);
});

// group products
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/category/index_category', [CategoryController::class , 'index_category']);
    Route::post('/v1/category/store_category', [CategoryController::class , 'store_category']);
    Route::get('/v1/category/edit_category/{category_id}', [CategoryController::class , 'edit_category']);
    Route::put('/v1/category/update_category/{category_id}', [CategoryController::class , 'update_category']);
    Route::delete('/v1/category/destroy_category/{category_id}', [CategoryController::class , 'destroy_category']);
    //products
    Route::get('/v1/product/index_product', [ProductController::class , 'index_product']);
    Route::post('/v1/product/store_product', [ProductController::class , 'store_product']);
    Route::get('/v1/product/edit_product/{product_id}', [ProductController::class , 'edit_product']);
    Route::put('/v1/product/update_product/{product_id}', [ProductController::class , 'update_product']);
    Route::delete('/v1/product/destroy_product/{product_id}', [ProductController::class , 'destroy_product']);
    //cart
    Route::get('/v1/cart/index_cart', [CartController::class , 'index_cart']);
    Route::post('/v1/cart/store_cart', [CartController::class , 'store_cart']);
    Route::get('/v1/cart/edit_cart/{cart_id}', [CartController::class , 'edit_cart']);
    Route::put('/v1/cart/update_cart/{cart_id}', [CartController::class , 'update_cart']);
});