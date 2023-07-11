<?php

namespace App\Http\Controllers\Feature\Quran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Services\Feature\Quran\QuranServices;



class QuranController extends Controller
{
    /**
     * fetch list surah
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : JsonResponse{
        return response()->json([
            'message' => 'success',
            'data' => (new QuranServices())->fetchListSurah()
        ]);
    }
}
