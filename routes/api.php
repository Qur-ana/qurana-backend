<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Feature\Quran\QuranController;
use App\Http\Controllers\Feature\PrayerTimes\CityController;
use App\Http\Controllers\Feature\PrayerTimes\PrayerController;
use App\Http\Controllers\Feature\AsmaulHusna\AsmaulHusnaController;

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

Route::prefix('feature')->middleware('isVerified')->group(function (): void {
    Route::prefix('quran')->group(function (): void {
        Route::get('/', [QuranController::class, 'index']);
        Route::get('/surah', [QuranController::class, 'detailSurah']);
        Route::get('/tafseer/{ayah}', [QuranController::class, 'tafseerAyat']);
    });
    Route::prefix('prayertimes')->group(function (): void {
        Route::get('/city', [CityController::class, 'index']);
        Route::get('/times/{city}', [PrayerController::class, 'getPrayerTimes']);
    });
    Route::prefix('asmaulhusna')->group(function (): void {
        Route::get('/', [AsmaulHusnaController::class, 'index']);
    });
});
