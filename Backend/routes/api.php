<?php

use App\Http\Controllers\api\CarModelController;
use App\Http\Controllers\api\ConfigController;
use App\Http\Controllers\api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('models', CarModelController::class);

Route::apiResource('configs', ConfigController::class);

Route::apiResource('orders', OrderController::class);
