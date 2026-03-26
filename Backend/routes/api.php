<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CarModelController;
use App\Http\Controllers\api\ConfigController;
use App\Http\Controllers\api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

// Public read-only routes (no auth required)
Route::apiResource('configs', ConfigController::class)->only(['index', 'show']);
Route::apiResource('orders', OrderController::class)->only(['index', 'show']);
Route::apiResource('models', CarModelController::class)->only(['index', 'show']);

// Protected routes (auth required)
Route::middleware('auth:sanctum')->group( function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    Route::apiResource('configs', ConfigController::class)->except(['index', 'show']);
    Route::apiResource('orders', OrderController::class)->except(['index', 'show']);
    Route::apiResource('models', CarModelController::class)->except(['index', 'show']);
});
