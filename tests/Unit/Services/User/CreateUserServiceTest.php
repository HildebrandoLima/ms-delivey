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
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataUser();
    }

    public function test_success_create_user_service(): void
    {
        // Arrange
        $this->request = new CreateUserRequest();
        $this->request['nome'] = $this->data['nome'];
        $this->request['cpf'] = $this->data['cpf'];
        $this->request['email'] = $this->data['email'];
        $this->request['senha'] = $this->data['password'];
        $this->request['dataNascimento'] = $this->data['dataNascimento'];
        $this->request['genero'] = $this->data['genero'];
        $this->request['perfil'] = $this->data['perfil'];

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
        $this->assertEquals($this->request['nome'], $this->data['nome']);
        $this->assertEquals($this->request['cpf'], $this->data['cpf']);
        $this->assertEquals($this->request['email'], $this->data['email']);
        $this->assertEquals($this->request['senha'], $this->data['password']);
        $this->assertEquals($this->request['dataNascimento'], $this->data['dataNascimento']);
        $this->assertEquals($this->request['genero'], $this->data['genero']);
        $this->assertEquals($this->request['perfil'], $this->data['perfil']);

        Queue::assertPushed(EmailForRegisterJob::class, function ($user) {
            return $user;
        });
    }
}
