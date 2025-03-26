<?php

namespace App\Repository\user;

use App\Dto\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserPostgresqlRepository implements UserRepository
{
    function create(UserDTO $userDTO): User
    {
        $user = new User();
        $user->fill([
            'username' => $userDTO->getUsername(),
            'email' => $userDTO->getEmail(),
            'password' => Hash::make($userDTO->getPassword())
            ])->save();
        return $user;
    }

    function findByEmailAndPassword(string $email, string $password): User
    {
        return User::query()
            ->where('email', $email)
            ->where('password', $password)
            ->firstOrFail();
    }
}
