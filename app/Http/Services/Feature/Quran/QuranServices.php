<?php

namespace App\Http\Services\Feature\Quran;

use App\Repository\QuranRepository\EloquentQuranRepository;

class QuranServices
{
    /**
     * fetch list surah
     *
     * @return array<string, mixed>
     */
    public function fetchListSurah(): array
    {
        $data = (new EloquentQuranRepository())->fetchListSurah();
        return $data;
    }

    /**
     * fetch list ayat
     *
     * @param integer $surah
     * @return array<string, mixed>
     */
    public function fetchListAyat(string $surah): array
    {
        $data = (new EloquentQuranRepository())->fetchListAyat($surah);
        return $data;
    }
}
