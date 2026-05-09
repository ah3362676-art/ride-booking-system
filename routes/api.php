<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\RideMatchController;
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

    /*
    |--------------------------------------------------------------------------
    | Ride Matches API Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('trip-requests/{tripRequest}/matches')->group(function () {
        Route::get('/', [RideMatchController::class, 'index']);
        Route::post('/generate', [RideMatchController::class, 'generate']);
        Route::get('/{rideMatch}', [RideMatchController::class, 'show']);
        Route::post('/{rideMatch}/accept', [RideMatchController::class, 'accept']);
        Route::post('/{rideMatch}/reject', [RideMatchController::class, 'reject']);
    });

});
