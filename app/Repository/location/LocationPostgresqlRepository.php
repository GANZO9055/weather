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

    public function create(LocationDTO $locationDto): Model
    {
        return Location::query()->firstOrCreate([
            'name' => $locationDto->getName(),
            'user_id' => $locationDto->getUserId(),
            'latitude' => $locationDto->getLatitude(),
            'longitude' => $locationDto->getLongitude(),
        ]);
    }

    function delete(int $id): bool
    {
        $location = Location::query()->find($id);
        if ($location != null) {
            return $location->delete();
        }
        return false;
    }
}
