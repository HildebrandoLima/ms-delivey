<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\User\EditUserRequest;
use App\Domains\Models\Endereco;
use App\Domains\Models\Item;
use App\Domains\Models\Pedido;
use App\Domains\Models\Telefone;
use App\Domains\Models\User;
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
        $editedUser = User::query()->first();
        $itemAndOrder = Item::query()->join('pedido as p', 'p.id', '=', 'item.pedido_id')
        ->where('p.usuario_id', '=', $editedUser->id)->first()->toArray();
        $address = Endereco::query()->where('usuario_id', '=', $editedUser->id)->first()->toArray();
        $telephone = Telefone::query()->where('usuario_id', '=', $editedUser->id)->first()->toArray();
        $this->request = new EditUserRequest();
        $this->request['id'] = $editedUser->id;
        $this->request['nome'] = $editedUser->nome;
        $this->request['email'] = $editedUser->email;
        $this->request['genero'] = $editedUser->genero;
        $this->request['ativo'] = $editedUser->e_admin;
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
        $mappedItem = $editUserService->mapItem($itemAndOrder['id'], $itemAndOrder['ativo']);
        $mappedOrder = $editUserService->mapOrder($itemAndOrder['pedido_id'], $itemAndOrder['ativo']);
        $mappedAddress = $editUserService->mapAddress($address['id'], $address['ativo']);
        $mappedTelephone = $editUserService->mapTelephone($telephone['id'], $telephone['ativo']);
        $mappedUser = $editUserService->mapUser($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Item::class, $mappedItem);
        $this->assertInstanceOf(Pedido::class, $mappedOrder);
        $this->assertInstanceOf(Endereco::class, $mappedAddress);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertInstanceOf(User::class, $mappedUser);
        $this->assertEquals($this->request['id'], $editedUser->id);
        $this->assertEquals($this->request['nome'], $editedUser->nome);
        $this->assertEquals($this->request['email'], $editedUser->email);
        $this->assertEquals($this->request['genero'], $editedUser->genero);
        $this->assertEquals($this->request['ativo'], $editedUser->ativo);
    }
}
