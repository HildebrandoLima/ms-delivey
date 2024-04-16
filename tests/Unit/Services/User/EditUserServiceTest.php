<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\User\Concretes\EditUserService;
use App\Http\Requests\User\EditUserRequest;
use App\Models\Endereco;
use App\Models\Item;
use App\Models\Pedido;
use App\Models\Telefone;
use App\Models\User;
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
        $editedUser = Pedido::query()->with('usuario')->with('item')->with('endereco')->first();
        $item = $editedUser->item->first();
        $order = $editedUser->first();
        $user = $editedUser->usuario->first();
        $address = $editedUser->endereco->first();
        $telephone = User::query()->with('telefone')->first()->telefone[0];

        $this->request = new EditUserRequest();
        $this->request['id'] = $user->id;
        $this->request['nome'] = $user->nome;
        $this->request['email'] = $user->email;
        $this->request['genero'] = $user->genero;
        $this->request['ativo'] = $user->ativo;
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
        $mappedUser = $editUserService->mapUser($this->request);
        $mappedItem = $editUserService->mapItem($item->id, $item->ativo);
        $mappedOrder = $editUserService->mapOrder($order->id, $order->ativo);
        $mappedAddress = $editUserService->mapAddress($address->id, $address->ativo);
        $mappedTelephone = $editUserService->mapTelephone($telephone->id, $telephone->ativo);
        $mappedUser = $editUserService->mapUser($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Item::class, $mappedItem);
        $this->assertInstanceOf(Pedido::class, $mappedOrder);
        $this->assertInstanceOf(Endereco::class, $mappedAddress);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertInstanceOf(User::class, $mappedUser);
        $this->assertEquals($this->request['id'], $user->id);
        $this->assertEquals($this->request['nome'], $user->nome);
        $this->assertEquals($this->request['email'], $user->email);
        $this->assertEquals($this->request['genero'], $user->genero);
        $this->assertEquals($this->request['ativo'], $user->ativo);
    }
}
