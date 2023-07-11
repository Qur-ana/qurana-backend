<?php

namespace Tests\Feature\Feature\Quran;

use App\Http\Services\Feature\Quran\QuranServices;
use App\Http\Resources\Feature\Quran\GetAllSurahResource;
use App\Http\Resources\Feature\Quran\GetAllAyatResource;
use App\Http\Requests\Feature\Quran\DetailSurahRequest;
use App\Http\Controllers\Feature\Quran\QuranController;
use Illuminate\Http\JsonResponse;
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
        $mockService->expects($this->once())
            ->method('fetchListSurah')
            ->willReturn([
                ['nomor' => '1', 'nama' => 'الفاتحة', 'nama_latin' => 'Al-Fatihah', 'jumlah_ayat' => 7, 'tempat_turun' => 'mekah', 'arti' => 'Pembukaan', 'deskripsi' => "Surat <i>Al Faatihah</i> (Pembukaan) yang diturunkan di Mekah dan terdiri dari 7 ayat adalah surat yang pertama-tama diturunkan dengan lengkap  diantara surat-surat yang ada dalam Al Quran dan termasuk golongan surat Makkiyyah. Surat ini disebut <i>Al Faatihah</i> (Pembukaan), karena dengan surat inilah dibuka dan dimulainya Al Quran. Dinamakan <i>Ummul Quran</i> (induk Al Quran) atau <i>Ummul Kitaab</i> (induk Al Kitaab) karena dia merupakan induk dari semua isi Al Quran, dan karena itu diwajibkan membacanya pada tiap-tiap sembahyang.<br> Dinamakan pula <i>As Sab'ul matsaany</i> (tujuh yang berulang-ulang) karena ayatnya tujuh dan dibaca berulang-ulang dalam sholat.", 'audio' => 'https://santrikoding.com/storage/audio/001.mp3']
            ]);

        $controller = new QuranController();
        $response = $controller->index($mockService);
        $expected = [
            'message' => 'success',
            'data' => [
                ['nomor' => '1', 'nama' => 'الفاتحة', 'nama_latin' => 'Al-Fatihah', 'jumlah_ayat' => 7, 'tempat_turun' => 'mekah', 'arti' => 'Pembukaan', 'deskripsi' => "Surat <i>Al Faatihah</i> (Pembukaan) yang diturunkan di Mekah dan terdiri dari 7 ayat adalah surat yang pertama-tama diturunkan dengan lengkap  diantara surat-surat yang ada dalam Al Quran dan termasuk golongan surat Makkiyyah. Surat ini disebut <i>Al Faatihah</i> (Pembukaan), karena dengan surat inilah dibuka dan dimulainya Al Quran. Dinamakan <i>Ummul Quran</i> (induk Al Quran) atau <i>Ummul Kitaab</i> (induk Al Kitaab) karena dia merupakan induk dari semua isi Al Quran, dan karena itu diwajibkan membacanya pada tiap-tiap sembahyang.<br> Dinamakan pula <i>As Sab'ul matsaany</i> (tujuh yang berulang-ulang) karena ayatnya tujuh dan dibaca berulang-ulang dalam sholat.", 'audio' => 'https://santrikoding.com/storage/audio/001.mp3']
            ]
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

        $mockService->expects($this->once())
            ->method('fetchListAyat')
            ->with(112)
            ->willReturn([
                'nama_latin' => 'Al-Ikhlas',
                'nomor' => '112'
            ]);

        $controller = new QuranController();
        $response = $controller->detailSurah($request, $mockService);
        $expected = [
            'message' => 'success',
            'data' => [
                'nama_latin' => 'Al-Ikhlas',
                'nomor' => '112'
            ],
        ];

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($expected, $response->getData(true));
    }

}
