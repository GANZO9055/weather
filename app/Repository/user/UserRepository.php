<?php

namespace App\Repository\user;

use App\Dto\UserDTO;
use App\Models\User;

interface UserRepository
{
    function create(UserDTO $userDTO): User;
}
