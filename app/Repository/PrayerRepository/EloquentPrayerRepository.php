<?php

namespace App\Repository\PrayerRepository;

use App\Models\Feature\PrayerTimes\City;
use GuzzleHttp\Client;

class EloquentPrayerRepository implements PrayerRepository
{
    private Client $client;
    private City $city;
    private string $host;

    /**
     * constructor
     * @param City $city
     * @return void
     */
    public function __construct(City $city){
        $this->client = new Client();
        $this->host = config('externalhost.prayer_api_url');
        $this->city = $city;
    }

    /**
     * get prayer times
     * @return object
     */
    public function getPrayerTimes() : object
    {
        $response = $this->client->request('GET', $this->host . 'sholat/jadwal/' . $this->city->external_id . '/' . now()->format('Y/m/d'));
        $response = json_decode($response->getBody()->getContents());
        return $response->data;
    }
}