<?php

namespace App\Http\Controllers\Feature\AsmaulHusna;

use App\Http\Controllers\Controller;
use App\Http\Services\Feature\AsmaulHusna\AsmaulHusnaServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AsmaulHusnaController extends Controller
{
    /**
     * fetch list asmaul husna
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(AsmaulHusnaServices $service) : JsonResponse
    {
        return response()->json(
            $service->fetchListAsmaulHusna()
        );
    }
}
