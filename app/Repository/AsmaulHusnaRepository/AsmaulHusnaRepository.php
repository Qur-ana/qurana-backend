<?php

namespace App\Repository\AsmaulHusnaRepository;
use Illuminate\Database\Eloquent\Collection;

interface AsmaulHusnaRepository
{
    public function fetchListAsmaulHusna() : Collection;
}
