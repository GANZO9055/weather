<?php

namespace App\Service\user;

use App\Dto\UserDTO;
use App\Models\User;

interface UserService
{
    function create(UserDTO $userDTO): User;
    function findByEmailAndPassword(string $email, string $password): User;
}
