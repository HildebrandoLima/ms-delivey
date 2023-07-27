<?php

namespace Tests\Unit\Services\User;

use App\DataTransferObjects\MappersDtos\UserMapperDto;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\ListUserService;
use App\Support\Enums\PerfilEnum;
use App\Support\Generate\GenerateCPF;
use App\Support\Generate\GenerateEmail;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListUserServiceTest extends TestCase
{
    private UserRepositoryInterface $userRepository;
    private int $id;
    private bool $active;
    private string $search;

    public function test_success_list_user_all_service(): void
    {
        // Arrange
        $this->search = '';
        $this->active = true;

        $expectedResult = $this->paginationList();

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService($this->userRepository);

        $result = $listUserService->listUserAll($this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_user_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;

        $collect = [
            'id' => $this->id,
            'provider_id' => 0,
            'provider' => '',
            'name' => Str::random(10),
            'cpf' => GenerateCPF::generateCPF(),
            'email' => GenerateEmail::generateEmail(),
            'data_nascimento' => date('Y-m-d H:i:s'),
            'genero' => '',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'is_admin' => 0,
            'endereco' => [],
            'telefone' => [],
            'ativo' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $collection = UserMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listUserService = new ListUserService($this->userRepository);

        $result = $listUserService->listUserFind($this->id, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
