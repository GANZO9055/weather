<?php

namespace App\Dto;

class WeatherDTO
{
    private int $id;
    private string $city;
    private float $temperature;

    /**
     * @param int $id
     * @param string $city
     * @param float $temperature
     */
    public function __construct(int $id, string $city, float $temperature)
    {
        $this->id = $id;
        $this->city = $city;
        $this->temperature = $temperature;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }
}
