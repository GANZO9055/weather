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

    public function getTemperatureByCoordinates(float $latitude, float $longitude): float
    {
        $newUrl = $this->url . 'latitude=' . $latitude . '&longitude=' . $longitude;
        return $this->getTemperature($newUrl);
    }

    public function getTemperatureByName(string $name): float
    {
        $newUrl = $this->url . 'query=' . $name;
        return $this->getTemperature($newUrl);
    }

    private function getTemperature(string $newUrl): float
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'X-Gismeteo-Token' => $this->apiKey,
            ])->get(
                $newUrl
            );
            return $response->json()['temperature']['air']['C'];
        } catch (ConnectionException $e) {
            echo $e->getMessage();
        }
        return 0;
    }
}
