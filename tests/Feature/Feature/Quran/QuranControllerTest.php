<?php

namespace Tests\Feature\Feature\Quran;

use App\Http\Services\Feature\Quran\QuranServices;
use App\Http\Resources\Feature\Quran\GetAllSurahResource;
use App\Http\Resources\Feature\Quran\GetAllAyatResource;
use App\Http\Requests\Feature\Quran\DetailSurahRequest;
use App\Http\Controllers\Feature\Quran\QuranController;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class QuranControllerTest extends TestCase
{
    /**
     * test for fetch list surah
     *
     * @return void
     * @covers \App\Http\Controllers\Feature\Quran\QuranController::index
     */
    public function testIndex()
    {
        $mockService = $this->createMock(QuranServices::class);
        $mockService
            ->expects($this->once())
            ->method('fetchListSurah')
            ->willReturn(
                new Collection([
                    'nomor' => '1',
                    'nama' => 'الفاتحة',
                    'nama_latin' => 'Al-Fatihah',
                    'jumlah_ayat' => 7,
                    'tempat_turun' => 'mekah',
                    'arti' => 'Pembukaan',
                    'deskripsi' => 'Surat <i>Al Faatihah</i> (Pembukaan) yang',
                    'audio' => 'https://santrikoding.com/storage/audio/001.mp3',
                ]),
            );

        $controller = new QuranController();
        $response = $controller->index($mockService);
        $expected = [
            'message' => 'success',
            'data' => ['nomor' => '1', 'nama' => 'الفاتحة', 'nama_latin' => 'Al-Fatihah', 'jumlah_ayat' => 7, 'tempat_turun' => 'mekah', 'arti' => 'Pembukaan', 'deskripsi' => "Surat <i>Al Faatihah</i> (Pembukaan) yang", 'audio' => 'https://santrikoding.com/storage/audio/001.mp3'],
        ];

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($expected, $response->getData(true));
    }

    /**
     *
     * @return void
     * @covers \App\Http\Controllers\Feature\Quran\QuranController::detailSurah
     */
    public function testDetailSurah()
    {
        $request = new DetailSurahRequest();
        $request->merge(['surah' => 112]);

        $mockService = $this->createMock(QuranServices::class);

        $mockService
            ->expects($this->once())
            ->method('fetchListAyat')
            ->with(112)
            ->willReturn(
                new Collection([
                    'nama_latin' => 'Al-Ikhlas',
                    'nomor' => '112',
                ]),
            );

        $controller = new QuranController();
        $response = $controller->detailSurah($request, $mockService);
        $expected = [
            'message' => 'success',
            'data' => [
                'nama_latin' => 'Al-Ikhlas',
                'nomor' => '112',
            ],
        ];

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($expected, $response->getData(true));
    }
}
