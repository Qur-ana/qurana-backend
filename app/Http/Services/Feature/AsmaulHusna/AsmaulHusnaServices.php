<?php
namespace App\Http\Services\Feature\AsmaulHusna;

use App\Repository\AsmaulHusnaRepository\EloquentAsmaulHusnaRepository;
use Illuminate\Database\Eloquent\Collection;

class AsmaulHusnaServices
{
    /**
     * fetch list asmaul husna
     */
    public function fetchListAsmaulHusna() : Collection
    {
        $data = (new EloquentAsmaulHusnaRepository())->fetchListAsmaulHusna();
        return $data;
    }
}