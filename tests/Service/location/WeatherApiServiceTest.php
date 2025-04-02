<?php

namespace Tests\Service\location;

use App\Service\location\WeatherApiService;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class WeatherApiServiceTest extends TestCase
{
    public function testWeatherByCoordinates()
    {
        $weather = new WeatherApiService();

        $value = $weather->getTemperatureByCoordinates('47.2313', '39.7233');

        assertEquals($value, 15.72);
    }

    public function testWeatherByNameCity()
    {
        $weather = new WeatherApiService();

        $value = $weather->getTemperatureByName('Rostov-on-Don');

        assertEquals($value, 15.92);
    }
}
