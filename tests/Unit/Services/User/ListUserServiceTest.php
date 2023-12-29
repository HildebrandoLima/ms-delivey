<?php

namespace Tests\Unit\Services\User;

use App\Repositories\Abstracts\IUserRepository;
use App\Services\User\Concretes\ListUserService;
use App\Support\Enums\PerfilEnum;
use App\Support\Utils\Pagination\Pagination;
use Mockery\MockInterface;
use Tests\TestCase;

class ListUserServiceTest extends TestCase
{
    private IUserRepository $userRepository;
    private Pagination $pagination;
    private int $id;
    private bool $filter;
    private string $search;

    public function test_success_list_user_all_has_pagination_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->search = '';
        $this->filter = true;

        $expectedResult = $this->paginationList();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->userRepository = $this->mock(IUserRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with(Pagination::class, $this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService($this->userRepository);

        $result = $listUserService->listUserAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_user_all_no_pagination_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->search = '';
        $this->filter = true;

        $expectedResult = $this->paginationList();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->userRepository = $this->mock(IUserRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with(Pagination::class, $this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService($this->userRepository);

        $result = $listUserService->listUserAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_user_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->filter = true;
        $expectedResult = collect([]);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->userRepository = $this->mock(IUserRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readOne')->with($this->id, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService($this->userRepository);

        $result = $listUserService->listUserFind($this->id, $this->filter);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
