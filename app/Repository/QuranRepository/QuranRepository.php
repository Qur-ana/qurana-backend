<?php

namespace App\Repository\QuranRepository;

interface QuranRepositoryInterface
{
    public function fetchListSurah();
    public function fetchListAyat($surah);
}