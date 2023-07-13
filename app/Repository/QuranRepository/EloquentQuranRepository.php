<?php

namespace App\Repository\QuranRepository;

use App\Models\Feature\Quran\Surah;
use App\Models\Feature\Quran\Ayah;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;

class EloquentQuranRepository implements QuranRepository
{
    /**
     * fetch list surah
     *
     * @return array<string, mixed>
     */
    public function fetchListSurah() : Collection
    {
        return Surah::all();
    }

    /**
     * fetch list ayat
     *
     * @param string $surah
     * @return array<string, mixed>
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchListAyat(string $surah) : Collection
    {
        return Ayah::where('surah_id', $surah)->orderBy('id')->get();
    }

    public function fetchTafseerAyat(Ayah $ayah) : array
    {
        $client = new Client();
        $host = config('externalhost.prayer_api_url');
        $response = $client->request('GET', $host . 'tafsir/quran/kemenag/id/' . $ayah->id);
        $tafseer = json_decode($response->getBody()->getContents(), true);
        return $tafseer;
    }
}