<?php

namespace App\Repository\location;

use App\Dto\LocationDTO;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class LocationPostgresqlRepository implements LocationRepository
{

    function findAll(): Collection
    {
        return Location::all();
    }

    function create(LocationDTO $locationDto): bool
    {
        return Location::query()->firstOrCreate([
            'name' => $locationDto->getName(),
            'latitude' => $locationDto->getLatitude(),
            'longitude' => $locationDto->getLongitude(),
        ]);
    }

    function delete(int $id): bool
    {
        return Location::query()->find($id)->delete();
    }
}
