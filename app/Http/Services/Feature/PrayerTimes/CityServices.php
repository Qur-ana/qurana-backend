<?php

namespace App\Http\Services\Feature\PrayerTimes;

use App\Repository\CityRepository\QueryBuilderCityRepository;

class CityServices
{
    public function fetchListCity()
    {
        return (new QueryBuilderCityRepository())->fetchListCity();
    }
}