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
            function (MockInterface $mock) use ($active) {
                $mock->shouldReceive('checkUserIdExist')->with($active);
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
        $this->assertEquals(count($result->toArray()['list']), count($expectedResult->toArray()['list']));
    }
}
