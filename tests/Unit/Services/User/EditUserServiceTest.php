<?php

namespace Tests\Unit\Services\User;

use App\Http\Requests\User\EditUserRequest;
use App\Models\Endereco;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\Telefone;
use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\User\Concretes\EditUserService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditUserServiceTest extends TestCase
{
    private EditUserRequest $request;
    private IEntityRepository $userRepository;

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $this->request = new EditUserRequest();
        $this->request['id'] = rand(1, 100);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->userRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('read')->with(Item::class, $this->request['id'])->andReturn(collect([]));
                $mock->shouldReceive('update')->with(Item::class)->andReturn(true);
                $mock->shouldReceive('update')->with(Pedido::class)->andReturn(true);
                $mock->shouldReceive('read')->with(User::class, $this->request['id'])->andReturn(collect([]));
                $mock->shouldReceive('update')->with(Endereco::class)->andReturn(true);
                $mock->shouldReceive('update')->with(Telefone::class)->andReturn(true);
                $mock->shouldReceive('update')->with(User::class)->andReturn(true);
        });

        // Act
        $editUserService = new EditUserService($this->userRepository);

        $result = $editUserService->editUser($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
