<?php

namespace App\Service\location;

use App\Dto\LocationDTO;
use Illuminate\Database\Eloquent\Collection;

interface LocationService
{
    function findAll(): Collection;
    function create(LocationDTO $locationDto): bool;
    function delete(int $id): bool;
}
