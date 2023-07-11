<?php

namespace App\Repository\QuranRepository;

use GuzzleHttp\Client;

class EloquentQuranRepository
{
    private string $host;

    public function __construct(){
        $this->host = config('externalhost.quran_api_url');
    }
    /**
     * fetch list surah
     *
     * @return array<string, mixed>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchListSurah() : array
    {
        $client = new Client();
        $response = $client->request('GET', $this->host . 'quran/surah');
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * fetch list ayat
     *
     * @param string $surah
     * @return array<string, mixed>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchListAyat(string $surah) : array
    {
        $client = new Client();
        $response = $client->request('GET', $this->host . 'quran/surah/' . $surah);
        return json_decode($response->getBody()->getContents(), true);
    }
}