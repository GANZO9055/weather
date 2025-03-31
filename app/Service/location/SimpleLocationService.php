<?php

namespace App\Service\location;

use App\Dto\LocationDTO;
use App\Repository\location\LocationRepository;
use Illuminate\Database\Eloquent\Collection;

class SimpleLocationService implements LocationService
{

    private LocationRepository $repository;

    /**
     * @param LocationRepository $repository
     */
    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }


    function findAll(): Collection
    {
        return $this->repository->findAll();
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
