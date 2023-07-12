<?php

namespace App\Http\Controllers\Feature\PrayerTimes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Feature\PrayerTimes\CityServices;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    /**
     * fetch list city
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse{
        return response()->json([
            'message' => 'success',
            'data' => (new CityServices())->fetchListCity()
        ]);
    }
}
