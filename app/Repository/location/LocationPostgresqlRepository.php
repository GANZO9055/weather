<?php

namespace App\Repository\location;

use App\Dto\LocationDTO;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LocationPostgresqlRepository implements LocationRepository
{

    public function findById(int $id): Model
    {
        return Location::query()->find($id);
    }

    public function findAll(): Collection
    {
        return Location::all();
    }

    public function create(LocationDTO $locationDto): bool
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
