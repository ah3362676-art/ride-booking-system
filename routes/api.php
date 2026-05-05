<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Api\TripRequestController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Auth Routes
|--------------------------------------------------------------------------
*/

// التسجيل
Route::post('/register', [AuthApiController::class, 'register']);

// تسجيل الدخول
Route::post('/login', [AuthApiController::class, 'login']);

// المسارات المحمية بـ Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // بيانات المستخدم الحالي
    Route::get('/me', [AuthApiController::class, 'me']);

    // تسجيل الخروج
    Route::post('/logout', [AuthApiController::class, 'logout']);

    // مركبات المستخدم
        Route::apiResource('vehicle', VehicleController::class);

    // رحلات المستخدم
        Route::apiResource('trip', TripController::class);

            Route::apiResource('trips-requests', TripRequestController::class);



});
