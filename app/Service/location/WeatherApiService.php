<?php

namespace App\Service\location;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class WeatherApiService
{
    private string $url;
    private string $apiKey;

    /**
     * @param string $url
     * @param string $apiKey
     */
    public function __construct()
    {
        $this->url = 'https://api.gismeteo.net/v2/weather/current/?';
        $this->apiKey = $_ENV['GISMETEO_API_KEY'];
    }


    /**
     * @throws ConnectionException
     */
    function getWeatherByCoordinates(float $latitude, float $longitude): object
    {
        $newUrl = $this->url . 'latitude=' . $latitude . '&longitude=' . $longitude;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Gismeteo-Token'=>$_ENV['GISMETEO_API_KEY'],
        ])->get(
            $newUrl
        );
        return $response->object();
    }

    /**
     * @throws ConnectionException
     */
    function grtWeatherByName(string $name): object
    {
        $newUrl = $this->url . 'query=' . $name;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Gismeteo-Token'=>$_ENV['GISMETEO_API_KEY'],
        ])->get(
            $newUrl
        );
        return $response->object();
    }
}
