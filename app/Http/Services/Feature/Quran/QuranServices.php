<?php

namespace App\Http\Services\Feature\Quran;

use App\Repository\QuranRepository\EloquentQuranRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Feature\Quran\Ayah;

class QuranServices
{
    /**
     * fetch list surah
     *
     * @return array<string, mixed>
     */
    public function fetchListSurah(): Collection
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
    public function fetchListAyat(string $surah): Collection
    {
        $data = (new EloquentQuranRepository())->fetchListAyat($surah);
        return $data;
    }

    public function fetchTafseerAyat(Ayah $ayah): array
    {
        $data = (new EloquentQuranRepository())->fetchTafseerAyat($ayah);
        return $data;
    }
}
