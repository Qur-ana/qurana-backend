<?php

namespace App\Http\Controllers\Feature\PrayerTimes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\Feature\PrayerTimes\PrayerServices;
use App\Models\Feature\PrayerTimes\City;

class PrayerController extends Controller
{
    /**
     * get prayer times
     *
     * @param City $city
     * @return JsonResponse
     */
    public function getPrayerTimes(City $city, PrayerServices $service) : JsonResponse
    {
        return response()->json($service->getPrayerTimes($city));
    }
}
