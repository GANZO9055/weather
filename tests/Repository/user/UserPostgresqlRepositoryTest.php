<?php

namespace Tests\Repository\user;

use App\Dto\UserDTO;
use App\Models\User;
use App\Repository\user\UserPostgresqlRepository;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class UserPostgresqlRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testWhenRegisterUserThenCheckInDatabase(): void
    {
        $testUser = new UserDTO('test1', 'test@test.com', 'test12345');
        $user = new UserPostgresqlRepository();

        $user->create($testUser);

        $value = User::query()
            ->where('email', $testUser->getEmail())
            ->first();

        assertEquals($testUser->getEmail(), $value->getAttribute('email'));
    }

    public function testWhenRegisterUserThenCheckOutDatabaseByEmailAndPassword(): void
    {
        $testUser = new UserDTO('test1', 'test@test.com', 'test12345');
        $user = new UserPostgresqlRepository();

        $user->create($testUser);

        $value = $user->findByEmailAndPassword(
            $testUser->getEmail(),
            $testUser->getPassword()
        );

        assertEquals($testUser->getEmail(), $value->getAttribute('email'));
    }

    public function testWhenRegisterTwoUsersWithSameEmailThenCheckError(): void
    {
        $testUser1 = new UserDTO('test1', 'test@test.com', 'test12345');
        $testUser2 = new UserDTO('test2', 'test@test.com', 'test12345');
        $user = new UserPostgresqlRepository();

        $user->create($testUser1);

        $this->expectException(UniqueConstraintViolationException::class);
        $this->expectExceptionMessage('Ключ "(email)=(test@test.com)" уже существует.');

        $user->create($testUser2);
    }
}
