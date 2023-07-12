<?php

namespace App\Repository\QuranRepository;

use Illuminate\Database\Eloquent\Collection;

interface QuranRepository
{
    public function fetchListSurah();
    public function fetchListAyat(string $surah) : Collection;
}