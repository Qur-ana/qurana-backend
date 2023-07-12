<?php

namespace Tests\Feature\Feature\PrayerTimes;

use App\Http\Controllers\Feature\PrayerTimes\PrayerController;
use App\Http\Services\Feature\PrayerTimes\PrayerServices;
use App\Models\Feature\PrayerTimes\City;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class PrayerControllerTest extends TestCase
{
    /**
     * test get prayer times
     * @return void
     */
    public function testGetPrayerTimes()
    {
        $city = new City();
        $city->id = 1;
        $city->name = 'Sleman';
        $mockPrayerServices = $this->createMock(PrayerServices::class);
        $mockPrayerServices->expects($this->once())
            ->method('getPrayerTimes')
            ->with($city)
            ->willReturn([
                'id' => '1',
                'lokasi' => 'Sleman',
                'daerah' => 'DI Yogyakarta',
            ]);

        $controller = new PrayerController();
        $response = $controller->getPrayerTimes($city, $mockPrayerServices);

        $this->assertInstanceOf(JsonResponse::class, $response);

        $expectedData = [
            'id' => '1',
            'lokasi' => 'Sleman',
            'daerah' => 'DI Yogyakarta',
        ];

        $responseData = $response->getData(true);
        $this->assertEquals($expectedData, $responseData);
    }
}
