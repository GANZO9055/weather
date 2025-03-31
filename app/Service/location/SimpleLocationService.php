<?php

namespace App\Service\location;

use App\Dto\LocationDTO;
use App\Models\Location;
use App\Repository\location\LocationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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


    function findById(int $id): Model
    {
        return $this->repository->findById($id);
    }

    public function findAll(): Collection
    {
        return Location::all();
    }

    function create(LocationDTO $locationDto): bool
    {
        return $this->repository->create($locationDto);
    }

    function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
