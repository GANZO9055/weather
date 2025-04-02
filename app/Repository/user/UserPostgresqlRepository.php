<?php

namespace App\Repository\user;

use App\Dto\UserDTO;
use App\Models\User;
use http\Exception\RuntimeException;
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
        $user = User::query()->where('email', $email)->firstOrFail();

        if (!Hash::check($password, $user->password)) {
            throw new RuntimeException('Wrong password');
        }

        return $user;
    }
}
