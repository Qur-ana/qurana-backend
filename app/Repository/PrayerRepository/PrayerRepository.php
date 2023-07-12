<?php

namespace App\Repository\PrayerRepository;

use App\Models\Feature\PrayerTimes\City;

interface PrayerRepository
{
    public function getPrayerTimes() : object;
}