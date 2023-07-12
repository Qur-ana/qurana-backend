<?php

namespace App\Http\Services\Feature\PrayerTimes;

use App\Repository\PrayerRepository\EloquentPrayerRepository;
use App\Models\Feature\PrayerTimes\City;

class PrayerServices
{
    /**
     * get prayer times
     *
     * @param City $city
     * @return object
     */
    public function getPrayerTimes(City $city)
    {
        return (new EloquentPrayerRepository($city))->getPrayerTimes();
    }
}