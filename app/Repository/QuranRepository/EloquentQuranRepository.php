<?php

namespace App\Repository\QuranRepository;

use GuzzleHttp\Client;

class EloquentQuranRepository
{
    /**
     * fetch list surah
     *
     * @return array<string, mixed>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchListSurah() : array
    {
        $client = new Client();
        $response = $client->request('GET', 'https://open-api.my.id/api/quran/surah');
        return json_decode($response->getBody()->getContents(), true);
    }
}