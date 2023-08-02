<?php

namespace Tests\Unit\Services\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\CreateUserService;
use App\Support\Traits\GenerateCPF;
use App\Support\Traits\GenerateEmail;
use App\Support\Traits\GeneratePassword;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateUserServiceTest extends TestCase
{
    use GenerateCPF, GenerateEmail, GeneratePassword;
    private CreateUserRequest $request;
    private UserRepositoryInterface $userRepository;
    private PermissionRepositoryInterface $permissionRepository;
    private array $gender = array('Masculino', 'Feminino', 'Outro');
    private int $id;

    public function test_success_create_user_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->gender);
        $this->id = rand(1, 100);
        $this->request = new CreateUserRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['cpf'] = $this->generateCPF();
        $this->request['email'] = $this->generateEmail();
        $this->request['senha'] = $this->generatePassword();
        $this->request['dataNascimento'] = date('Y-m-d H:i:s');
        $this->request['genero'] = $this->gender[$rand_keys];
        $this->request['eAdmin'] = (bool)rand(0, 1); // 0 client 1 admin
        $this->request['ativo'] = true;

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(User::class)->andReturn($this->id);
        });

        $this->permissionRepository = $this->mock(PermissionRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->id, rand(1, 100))
                     ->andReturn(true);
        });

        // Act
        $createUserService = new CreateUserService
        (
            $this->userRepository,
            $this->permissionRepository
        );

        $result = $createUserService->createUser($this->request);

        // Assert
        $this->assertIsInt($result);
    }
}
