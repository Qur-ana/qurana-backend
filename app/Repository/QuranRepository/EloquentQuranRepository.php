<?php

namespace App\Repository\QuranRepository;

use App\Models\Feature\Quran\Surah;
use App\Models\Feature\Quran\Ayah;
use Illuminate\Database\Eloquent\Collection;

class EloquentQuranRepository
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
}