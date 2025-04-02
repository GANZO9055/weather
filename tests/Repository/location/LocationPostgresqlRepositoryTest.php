<?php

namespace Tests\Repository\location;

use App\Dto\LocationDTO;
use App\Dto\UserDTO;
use App\Models\Location;
use App\Repository\location\LocationPostgresqlRepository;
use App\Repository\user\UserPostgresqlRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class LocationPostgresqlRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateLocation()
    {
        $userDto = new UserDTO('test', 'test@test', 'test123');
        $user = new UserPostgresqlRepository();
        $newUser = $user->create($userDto);

        $locationDto = new LocationDTO('City', $newUser->getAttribute('id'), 23.0, 24.4);
        $location = new LocationPostgresqlRepository();
        $location->create($locationDto);

        assertEquals(
            $locationDto->getName(),
            Location::query()
                ->where('name', $locationDto->getName())
                ->first()
                ->getAttribute('name')
        );
    }

    public function testWhenCreateLocationThenFindById()
    {
        $userDto = new UserDTO('test', 'test@test', 'test123');
        $user = new UserPostgresqlRepository();
        $newUser = $user->create($userDto);

        $locationDto = new LocationDTO('City', $newUser->getAttribute('id'), 23.0, 24.4);
        $location = new LocationPostgresqlRepository();
        $locationNew = $location->create($locationDto);

        assertEquals(
            $locationDto->getName(),
            $location->findById($locationNew->getAttribute('id'))->getAttribute('name')
        );
    }

    public function testWhenCreateLocationsThenFindAll()
    {
        $userDto = new UserDTO('test', 'test@test', 'test123');
        $user = new UserPostgresqlRepository();
        $newUser = $user->create($userDto);
        $locationDto1 = new LocationDTO('City1', $newUser->getAttribute('id'), 23.0, 24.4);
        $locationDto2 = new LocationDTO('City2', $newUser->getAttribute('id'), 24.0, 25.4);
        $locationDto3 = new LocationDTO('City3', $newUser->getAttribute('id'), 25.0, 26.4);
        $location = new LocationPostgresqlRepository();
        $array = ['City1', 'City2', 'City3'];

        $location->create($locationDto1);
        $location->create($locationDto2);
        $location->create($locationDto3);

        $list = $location->findAll()
            ->map(function (Location $location) {
                return $location->getAttribute('name');
            })
            ->toArray();

        assertEquals($array, $list);
    }

    public function testWhenCreateLocationThenDeleteTrue()
    {
        $userDto = new UserDTO('test', 'test@test', 'test123');
        $user = new UserPostgresqlRepository();
        $newUser = $user->create($userDto);

        $locationDto = new LocationDTO('City', $newUser->getAttribute('id'), 23.0, 24.4);
        $location = new LocationPostgresqlRepository();
        $locationNew = $location->create($locationDto);

        assertTrue($location->delete($locationNew->getAttribute('id')));
    }

    public function testWhenCreateLocationThenDeleteFalse()
    {
        $userDto = new UserDTO('test', 'test@test', 'test123');
        $user = new UserPostgresqlRepository();
        $newUser = $user->create($userDto);

        $locationDto = new LocationDTO('City', $newUser->getAttribute('id'), 23.0, 24.4);
        $location = new LocationPostgresqlRepository();
        $location->create($locationDto);

        assertFalse($location->delete(2));
    }
}
