<?php

namespace App\Http\Controllers\Feature\PrayerTimes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Feature\PrayerTimes\CityServices;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Feature\PrayerTimes\GetAllCityResource;

class CityController extends Controller
{
    /**
     * fetch list city
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CityServices $service): JsonResponse{
        return response()->json(
            GetAllCityResource::collection($service->fetchListCity())
        );
    }
}
