<?php

namespace Tests\Feature\Feature\PrayerTimes;

use Tests\TestCase;
use App\Http\Controllers\Feature\PrayerTimes\CityController;
use App\Http\Services\Feature\PrayerTimes\CityServices;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Feature\PrayerTimes\GetAllCityResource;
use App\Models\Feature\PrayerTimes\City;
use Illuminate\Database\Eloquent\Collection;

class CityControllerTest extends TestCase
{
    public function testIndex()
    {
        $mockService = $this->createMock(CityServices::class);
        $mockService->expects($this->once())
            ->method('fetchListCity')
            ->willReturn([
                new City(['name' => 'City 1', 'external_id' => 1, 'id' => 1]),
                new City(['name' => 'City 2', 'external_id' => 2, 'id' => 2]),
            ]);

        $controller = new CityController();
        $response = $controller->index($mockService);

        $responseData = $response->getData(true);
        $expectedData = GetAllCityResource::collection(new Collection([
            new City(['name' => 'City 1', 'external_id' => 1, 'id' => 1]),
            new City(['name' => 'City 2', 'external_id' => 2, 'id' => 2]),
        ]))->resolve();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($expectedData, $responseData);
    }
}
