<?php

namespace App\Repository\location;

use App\Dto\LocationDTO;
use Illuminate\Database\Eloquent\Collection;

interface LocationRepository
{
    function findAll(): Collection;
    function create(LocationDTO $locationDto): bool;
    function delete(int $id): bool;
}
