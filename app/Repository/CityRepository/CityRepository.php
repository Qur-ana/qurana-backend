<?php

namespace App\Repository\CityRepository;

use Illuminate\Database\Eloquent\Collection;

interface CityRepository
{
    /**
     * fetch list city
     *
     * @return array<string, mixed>
     */
    public function fetchListCity() : Collection;
}