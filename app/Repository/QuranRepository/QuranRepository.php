<?php

namespace App\Repository\QuranRepository;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Feature\Quran\Ayah;
use App\Models\Feature\Quran\Tafseer;

interface QuranRepository
{
    public function fetchListSurah() : Collection;
    public function fetchListAyat(string $surah) : Collection;
    public function fetchTafseerAyat(Ayah $ayah) : Tafseer;
}