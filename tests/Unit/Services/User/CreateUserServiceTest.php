<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Data\Repositories\Abstracts\IPermissionRepository;
use App\Domains\Services\User\Concretes\CreateUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\PermissionUser;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateUserServiceTest extends TestCase
{
    private CreateUserRequest $request;
    private IEntityRepository $userRepository;
    private IPermissionRepository $permissionRepository;

    public function test_success_create_user_service(): void
    {
        // Arrange
        $createdUser = User::query()->first();
        $this->request = new CreateUserRequest();
        $this->request['nome'] = $createdUser->nome;
        $this->request['cpf'] = $createdUser->cpf;
        $this->request['email'] = $createdUser->email;
        $this->request['senha'] = $createdUser->password;
        $this->request['dataNascimento'] = $createdUser->data_nascimento;
        $this->request['genero'] = $createdUser->genero;
        $this->request['eAdmin'] = $createdUser->e_admin;
        $userId = $createdUser->id;

        $this->userRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(User::class)->andReturn(true);
        });

        $this->permissionRepository = $this->mock(IPermissionRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(PermissionUser::class)->andReturn(true);
        });

        // Act
        Queue::fake();
        $createUserService = new CreateUserService($this->userRepository, $this->permissionRepository);
        $resultUser = $createUserService->createUser($this->request);
        $resultPermission = $createUserService->createPermission($this->request['eAdmin'], $userId);
        $mappedUser = $createUserService->mapUser($this->request);
        $mappedPermission = $createUserService->mapPermission($userId, 1);

        // Assert
        $this->assertIsInt($resultUser);
        $this->assertTrue($resultPermission);
        $this->assertInstanceOf(User::class, $mappedUser);
        $this->assertInstanceOf(PermissionUser::class, $mappedPermission);
        $this->assertEquals($this->request['nome'], $createdUser->nome);
        $this->assertEquals($this->request['cpf'], $createdUser->cpf);
        $this->assertEquals($this->request['email'], $createdUser->email);
        $this->assertEquals($this->request['senha'], $createdUser->password);
        $this->assertEquals($this->request['dataNascimento'], $createdUser->data_nascimento);
        $this->assertEquals($this->request['genero'], $createdUser->genero);
        $this->assertEquals($this->request['eAdmin'], $createdUser->e_admin);

        Queue::assertPushed(EmailForRegisterJob::class, function ($user) {
            return $user;
        });
    }
}
