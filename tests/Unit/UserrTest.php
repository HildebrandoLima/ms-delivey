<?php

namespace Tests\Unit;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\CreateUserService;
use App\Support\Generate\GenerateEmail;
use App\Support\Generate\GeneratePassword;
use App\Support\Permissions\CreatePermissions;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class UserrTest extends TestCase
{
    private UserRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface $userRepository;
    private CreatePermissions $createPermissions;
    private array $gender = array('Masculino', 'Feminino', 'Outro');

    public function test_service_success(): void
    {
        // Arrange
        $rand_keys = array_rand($this->gender);
        $this->request = new UserRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['cpf'] = '748.498.870-74';
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['senha'] = GeneratePassword::generatePassword();
        $this->request['dataNascimento'] = date('Y-m-d H:i:s');
        $this->request['genero'] = $this->gender[$rand_keys];
        $this->request['perfil'] = rand(0, 1); // 0 client 1 admin
        $this->request['ativo'] = true;

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('checkUserExist')->with($this->request);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(User::class)->andReturn(1);
        });

        $this->createPermissions = $this->mock(CreatePermissions::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('createPermissions')
            ->with($this->request['perfil'], 1)
            ->andReturn(true);
        });

        // Act
        $createUserService = new CreateUserService
        (
            $this->checkEntityRepository,
            $this->userRepository,
            $this->createPermissions
        );

        $result = $createUserService->createUser($this->request);

        // Assert
        $this->assertIsInt($result);
    }
}
