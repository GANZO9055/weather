<?php

namespace App\Dto;

class LocationDTO
{
    private string $name;
    private int $userId;
    private float $latitude;
    private float $longitude;

    /**
     * @param string $name
     * @param int $userId
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(string $name, int $userId, float $latitude, float $longitude)
    {
        $this->name = $name;
        $this->userId = $userId;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
