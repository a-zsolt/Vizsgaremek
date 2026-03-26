<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CarModelController;
use App\Http\Controllers\api\ConfigController;
use App\Http\Controllers\api\OrderController;
use App\Http\Requests\auth\LoginAuthRequest;
use App\Http\Requests\auth\RegisterAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('configs', ConfigController::class);

Route::apiResource('orders', OrderController::class);

Route::post('register', [RegisterAuthRequest::class, 'register']);

Route::post('login', [LoginAuthRequest::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
   Route::post('logout', [AuthController::class, 'logout']);
   Route::get('me', [AuthController::class, 'me']);

    Route::apiResource('models', CarModelController::class);

});
