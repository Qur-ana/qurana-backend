<?php

namespace App\Repository\QuranRepository;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Feature\Quran\Ayah;

interface QuranRepository
{
    public function fetchListSurah() : Collection;
    public function fetchListAyat(string $surah) : Collection;
    public function fetchTafseerAyat(Ayah $ayah) : array;
}