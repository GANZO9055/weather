<?php

namespace App\Service\location;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class WeatherApiService
{
    private string $url;
    private string $apiKey;
    private string $units;
    private string $verify;

    /**
     * @param string $url
     * @param string $apiKey
     */
    public function __construct()
    {
        $this->url = 'https://api.openweathermap.org/data/2.5/weather?';
        $this->apiKey = env('OPEN_WEATHER_MAP_API_KEY');
        $this->units = 'metric';
        $this->verify = env('VERIFY');
    }

    public function getTemperatureByCoordinates(float $latitude, float $longitude): float
    {
        $newUrl = $this->url . http_build_query([
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => $this->apiKey,
                'units' => $this->units
            ]);
        return $this->getTemperature($newUrl);
    }

    public function getTemperatureByName(string $name): float
    {
        $newUrl = $this->url . http_build_query([
                'q' => $name,
                'appid' => $this->apiKey,
                'units' => $this->units
            ]);
        return $this->getTemperature($newUrl);
    }

    private function getTemperature(string $newUrl): float
    {
        try {
            $response = Http::withOptions([
                'verify' => $this->verify
            ])->get($newUrl);
            return $response->json()['main']['temp'];
        } catch (ConnectionException $e) {
            echo $e->getMessage();
        }
        return 0;
    }
}
