<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('auth')->group(function (): void {
    Route::post('login', [AuthController::class, 'login']);
    Route::prefix('register')->group(function (): void {
        Route::post('/', [AuthController::class, 'register']);
        Route::post('/resend-otp', [AuthController::class, 'resendOTP'])->middleware('auth:api');
        Route::post('/verify-otp', [AuthController::class, 'verifyOTP'])->middleware('auth:api');
    });
    Route::middleware('auth:api')->group(function (): void {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'user']);
    });
});
