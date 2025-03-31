<?php

namespace App\Service\location;

use App\Dto\LocationDTO;
use Illuminate\Database\Eloquent\Model;

interface LocationService
{
    function findById(int $id): Model;
    function findAll();
    function create(LocationDTO $locationDto): bool;
    function delete(int $id): bool;
}
