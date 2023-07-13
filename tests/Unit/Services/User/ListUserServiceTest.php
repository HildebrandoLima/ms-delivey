<?php

namespace Tests\Unit\Services\User;

use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\ListUserService;
use App\Support\Utils\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class ListUserServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface $userRepository;

    public function test_success_list_user_all_service(): void
    {
        // Arrange
        $data = User::query()->limit(10)->get()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkUserIdExist')->with(1);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) {
                $data = User::query()->limit(10)->get();
                $mock->shouldReceive('getAll')->with(1)->andReturn(collect($data->toArray()));
        });

        // Act
        $listUserService = new ListUserService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $listUserService->listUserAll(1);

        // Assert
        $this->assertEquals(count($result), count($data));
    }
}
