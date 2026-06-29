<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\Frontend\Auth\AuthController as FrontendAuthController;

/*
|--------------------------------------------------------------------------
| Admin Authentication APIs
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::get('/profile', [AdminAuthController::class, 'profile']);
    });
});

/*
|--------------------------------------------------------------------------
| Frontend Authentication APIs
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->group(function () {

    Route::post('/login', [FrontendAuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [FrontendAuthController::class, 'logout']);
        Route::get('/profile', [FrontendAuthController::class, 'profile']);
    });
});