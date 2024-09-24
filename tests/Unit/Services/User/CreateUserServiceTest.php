<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Interfaces\ICreateUserRepository;
use App\Domains\Services\User\Concretes\CreateUserService;
use App\Http\Requests\User\CreateUserRequest;
use App\Jobs\EmailForRegisterJob;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateUserServiceTest extends TestCase
{
    private CreateUserRequest $request;
    private ICreateUserRepository $createUserRepository;
    private array $data = [];

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

        $this->createUserRepository = $this->mock(ICreateUserRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        Queue::fake();
        $createUserService = new CreateUserService($this->createUserRepository);
        $result = $createUserService->create($this->request);

        // Assert
        $this->assertIsInt($result);
        $this->assertEquals($this->request['nome'], $this->data['nome']);
        $this->assertEquals($this->request['cpf'], $this->data['cpf']);
        $this->assertEquals($this->request['email'], $this->data['email']);
        $this->assertEquals($this->request['senha'], $this->data['password']);
        $this->assertEquals($this->request['dataNascimento'], $this->data['dataNascimento']);
        $this->assertEquals($this->request['genero'], $this->data['genero']);
        $this->assertEquals($this->request['perfil'], $this->data['perfil']);

        Queue::assertPushed(EmailForRegisterJob::class,
            function ($user) {
                return $user;
        });
    }
}
