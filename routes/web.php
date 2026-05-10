<?php

use App\Http\Controllers\web\TripRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\RideMatchController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\VehicleController;
use App\Http\Controllers\Web\TripController;
use App\Http\Controllers\Web\TripPassengerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Guest Routes (لغير المسجلين)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (للمستخدم المسجل)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Vehicles
    |--------------------------------------------------------------------------
    */
    Route::resource('vehicles', VehicleController::class);

    /*
    |--------------------------------------------------------------------------
    | Trips
    |--------------------------------------------------------------------------
    */
    Route::resource('trips', TripController::class);

/*
    |--------------------------------------------------------------------------
    | Triprequests
    |--------------------------------------------------------------------------
    */
     Route::resource('trip-requests', TripRequestController::class);

      /*
    |--------------------------------------------------------------------------
    | Ride Matches Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('trip-requests/{tripRequest}/matches')->group(function () {
        Route::get('/', [RideMatchController::class, 'index'])->name('ride-matches.index');
        Route::post('/generate', [RideMatchController::class, 'generate'])->name('ride-matches.generate');
        Route::get('/{rideMatch}', [RideMatchController::class, 'show'])->name('ride-matches.show');
        Route::post('/{rideMatch}/accept', [RideMatchController::class, 'accept'])->name('ride-matches.accept');
        Route::post('/{rideMatch}/reject', [RideMatchController::class, 'reject'])->name('ride-matches.reject');
    });

         /*
    |--------------------------------------------------------------------------
    |  Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/my-trips', [TripPassengerController::class, 'myTrips'])
    ->name('my-trips');

});
