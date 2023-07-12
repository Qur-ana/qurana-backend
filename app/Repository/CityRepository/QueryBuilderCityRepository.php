<?php
namespace App\Repository\CityRepository;

use App\Models\Feature\PrayerTimes\City;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Collection;



class QueryBuilderCityRepository implements CityRepository
{
    /**
     * fetch list city
     *
     * @return array<string, mixed>
     */
    public function fetchListCity() : Collection
    {
        return QueryBuilder::for(City::class)
            ->allowedFilters([
                AllowedFilter::exact('external_id'),
                AllowedFilter::partial('name'),
            ])
            ->allowedSorts([
                'external_id',
                'name',
            ])
            ->get();
    }
}