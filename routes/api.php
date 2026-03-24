<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RouleclinetController;

Route::get('/v1/login',[AuthController::class, 'login']);
Route::post('/v1/role_store',[RoleController::class, 'role_store']);

Route::middleware('auth:sanctum')->group(function () {

});
Route::post('/v1/roule_client',[RouleclinetController::class,'roule_client']);
