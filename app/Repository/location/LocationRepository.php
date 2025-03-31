<?php

namespace App\Repository\location;

use App\Dto\LocationDTO;
use Illuminate\Database\Eloquent\Model;

interface LocationRepository
{
    function findById(int $id): Model;
    function findAll();
    function create(LocationDTO $locationDto): bool;
    function delete(int $id): bool;
}
