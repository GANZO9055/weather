<?php

namespace App\Service\location;

use App\Dto\LocationDTO;
use App\Dto\WeatherDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface LocationService
{
    function getLocationById(int $id): WeatherDTO;
    function getAllLocation(): array;
    function addLocation(LocationDTO $locationDto): Model;
    function deleteLocation(int $id): bool;
}
