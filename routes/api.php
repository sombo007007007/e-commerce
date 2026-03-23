<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/v1/login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

});
