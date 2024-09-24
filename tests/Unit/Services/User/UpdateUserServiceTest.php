<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Interfaces\IUpdateUserRepository;
use App\Domains\Services\User\Concretes\UpdateUserService;
use App\Http\Requests\User\UpdateUserRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateUserServiceTest extends TestCase
{
    private UpdateUserRequest $request;
    private IUpdateUserRepository $updateUserRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataUser();
    }

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $this->request = new UpdateUserRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['nome'] = $this->data['nome'];
        $this->request['email'] = $this->data['email'];
        $this->request['genero'] = $this->data['genero'];
        $this->request['ativo'] = $this->data['ativo'];

        $this->updateUserRepository = $this->mock(IUpdateUserRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $updateUserService = new UpdateUserService($this->updateUserRepository);
        $result = $updateUserService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['nome'], $this->data['nome']);
        $this->assertEquals($this->request['email'], $this->data['email']);
        $this->assertEquals($this->request['genero'], $this->data['genero']);
        $this->assertEquals($this->request['ativo'], $this->data['ativo']);
    }
}
