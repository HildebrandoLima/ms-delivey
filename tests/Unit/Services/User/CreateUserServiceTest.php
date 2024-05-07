<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\User\Concretes\CreateUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateUserServiceTest extends TestCase
{
    private CreateUserRequest $request;
    private IEntityRepository $userRepository;

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
        $this->request['perfil'] = $createdUser->role_id;

        $this->userRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(User::class)->andReturn(true);
        });

        // Act
        Queue::fake();
        $createUserService = new CreateUserService($this->userRepository);
        $resultUser = $createUserService->createUser($this->request);
        $mappedUser = $createUserService->mapUser($this->request);

        // Assert
        $this->assertIsInt($resultUser);
        $this->assertInstanceOf(User::class, $mappedUser);
        $this->assertEquals($this->request['nome'], $createdUser->nome);
        $this->assertEquals($this->request['cpf'], $createdUser->cpf);
        $this->assertEquals($this->request['email'], $createdUser->email);
        $this->assertEquals($this->request['senha'], $createdUser->password);
        $this->assertEquals($this->request['dataNascimento'], $createdUser->data_nascimento);
        $this->assertEquals($this->request['genero'], $createdUser->genero);
        $this->assertEquals($this->request['perfil'], $createdUser->role_id);

        Queue::assertPushed(EmailForRegisterJob::class, function ($user) {
            return $user;
        });
    }
}
