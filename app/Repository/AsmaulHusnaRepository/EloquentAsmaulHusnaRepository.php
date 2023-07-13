<?php

namespace App\Repository\AsmaulHusnaRepository;

use App\Models\Feature\AsmaulHusna\AsmaulHusna;
use Illuminate\Database\Eloquent\Collection;

class EloquentAsmaulHusnaRepository implements AsmaulHusnaRepository
{
    /**
     * fetch list asmaul husna
     */
    public function fetchListAsmaulHusna() : Collection
    {
        $data = AsmaulHusna::all();
        return $data;
    }
}