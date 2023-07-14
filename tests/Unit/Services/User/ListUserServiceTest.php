<?php

namespace Tests\Unit\Services\User;

use App\DataTransferObjects\MappersDtos\UserMapperDto;
use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\ListUserService;
use App\Support\Utils\Enums\PerfilEnum;
use App\Support\Utils\Pagination\PaginationList;
use Mockery\MockInterface;
use Tests\TestCase;

class ListUserServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface $userRepository;

    public function test_success_list_user_all_service(): void
    {
        // Arrange
        $id = rand(1, 100);
        $active = true;
        $collection = User::with('endereco')->with('telefone')->where('users.ativo', '=', $active)->orderByDesc('users.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = UserMapperDto::mapper($instance->toArray());
        endforeach;
        $expectedResult = PaginationList::createFromPagination($collection);

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkUserIdExist')->with($id);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $active) {
                $mock->shouldReceive('getAll')->with($active)
                ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $listUserService->listUserAll($active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray()['list']);
        $this->assertIsArray($expectedResult->toArray()['list']);
        $this->assertEquals(count($result->toArray()['list']), count($expectedResult->toArray()['list']));
    }

    public function test_success_list_user_find_id_service(): void
    {
        // Arrange
        $id = User::query()->first()->id;
        $active = true;
        $search = '%%';
        $collect = User::with('endereco')->with('telefone')->where('users.ativo', '=', $active)->where('users.id', '=', $id)
        ->orWhere('users.name', 'like', $search)->get()->toArray()[0];
        $collection = UserMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkUserIdExist')->with($id);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $id, $active) {
                $mock->shouldReceive('getOne')->with($id, '', $active)
                ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $listUserService->listUserFind($id, '', $active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }

    public function test_success_list_user_find_search_name_service(): void
    {
        // Arrange
        $id = 0;
        $active = true;
        $search = User::query()->first()->name;
        $collect = User::with('endereco')->with('telefone')->where('users.ativo', '=', $active)->where('users.id', '=', $id)
        ->orWhere('users.name', 'like', $search)->get()->toArray()[0];
        $collection = UserMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkUserIdExist')->with($id);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $id, $active) {
                $mock->shouldReceive('getOne')->with($id, '', $active)
                ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $listUserService->listUserFind($id, '', $active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }
}
