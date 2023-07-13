<?php

namespace App\Http\Controllers\Feature\Quran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\Feature\Quran\QuranServices;
use App\Http\Requests\Feature\Quran\DetailSurahRequest;
use App\Http\Resources\Feature\Quran\GetAllSurahResource;
use App\Http\Resources\Feature\Quran\GetAllAyatResource;
use App\Models\Feature\Quran\Ayah;

class QuranController extends Controller
{
    /**
     * fetch list surah
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(QuranServices $service): JsonResponse
    {
        return response()->json(
            new GetAllSurahResource($service->fetchListSurah())
        );
    }

    /**
     * fetch list ayat
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detailSurah(DetailSurahRequest $request, QuranServices $service): JsonResponse
    {
        return response()->json(
            new GetAllAyatResource($service->fetchListAyat($request->surah))
        );
    }

    /**
     * tafseer ayat
     */

    public function tafseerAyat(QuranServices $service, Ayah $ayah) : JsonResponse
    {
        return response()->json(
            $service->fetchTafseerAyat($ayah)
        );
    }
}
