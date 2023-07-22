<?php

namespace Tests\Unit\Services\User;

use App\DataTransferObjects\MappersDtos\UserMapperDto;
use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\ListUserService;
use App\Support\Enums\PerfilEnum;
use App\Support\Utils\Pagination\PaginationList;
use Mockery\MockInterface;
use Tests\TestCase;

class ListUserServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface $userRepository;
    private int $id;
    private bool $active;
    private string $search;

    public function test_success_list_user_all_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $collection = User::with('endereco')->with('telefone')->where('users.ativo', '=', $this->active)->orderByDesc('users.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = UserMapperDto::mapper($instance->toArray());
        endforeach;
        $expectedResult = PaginationList::createFromPagination($collection);

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkUserIdExist')->with($this->id);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $listUserService->listUserAll($this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray()['list']);
        $this->assertIsArray($expectedResult->toArray()['list']);
        $this->assertEquals(count($result->toArray()['list']), count($expectedResult->toArray()['list']));
    }

    public function test_success_list_user_find_id_service(): void
    {
        // Arrange
        $this->id = User::query()->first()->id;
        $this->active = true;
        $this->search = '%%';
        $collect = User::with('endereco')->with('telefone')->where('users.ativo', '=', $this->active)
        ->where('users.id', '=', $this->id)->orWhere('users.name', 'like', $this->search)->get()->toArray()[0];
        $collection = UserMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkUserIdExist')->with($this->id);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $listUserService->listUserFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }

    public function test_success_list_user_find_search_name_service(): void
    {
        // Arrange
        $this->id = 0;
        $this->active = true;
        $this->search = User::query()->first()->name;
        $collect = User::with('endereco')->with('telefone')->where('users.ativo', '=', $this->active)
        ->where('users.id', '=', $this->id)->orWhere('users.name', 'like', $this->search)->get()->toArray()[0];
        $collection = UserMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkUserIdExist')->with($this->id);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $listUserService->listUserFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }
}
