<?php

namespace App\Service\user;

use App\Dto\UserDTO;
use App\Models\User;
use App\Repository\user\UserRepository;

class SimpleUserService implements UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function create(UserDTO $userDTO): User
    {
        return $this->userRepository->create($userDTO);
    }

    function findByEmailAndPassword(string $email, string $password): User
    {
        return $this->userRepository->findByEmailAndPassword($email, $password);
    }
}
