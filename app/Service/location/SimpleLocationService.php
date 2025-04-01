<?php

namespace App\Service\location;

use App\Dto\LocationDTO;
use App\Dto\WeatherDTO;
use App\Models\Location;
use App\Repository\location\LocationRepository;
use Illuminate\Database\Eloquent\Collection;

class SimpleLocationService implements LocationService
{

    private LocationRepository $repository;
    private WeatherApiService  $weatherApiService;

    /**
     * @param LocationRepository $repository
     */
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
        $this->weatherApiService = new WeatherApiService();
    }


    function getLocationById(int $id): WeatherDTO
    {
        $location = $this->repository->findById($id);
        $temperature = $this->weatherApiService->getTemperatureByCoordinates(
            $location->getAttribute('latitude'),
            $location->getAttribute('longitude')
        );
        return new WeatherDTO(
            $location->getAttribute('id'),
            $location->getAttribute('name'),
            $temperature
        );
    }

    public function getAllLocation(): array
    {
        $array = [];
        $this->repository->findAll()->map(function (Location $location) use (&$array) {
            $array[] = new WeatherDTO(
                $location->getAttribute('id'),
                $location->getAttribute('name'),
                $this->weatherApiService->getTemperatureByCoordinates(
                    $location->getAttribute('latitude'),
                    $location->getAttribute('longitude')
                ));
        });
        return $array;
    }

    function addLocation(LocationDTO $locationDto): bool
    {
        return $this->repository->create($locationDto);
    }

    function deleteLocation(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
