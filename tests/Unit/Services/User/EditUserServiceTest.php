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
use Mockery\MockInterface;
use Tests\TestCase;

class EditUserServiceTest extends TestCase
{
    private EditUserRequest $request;
    private IEntityRepository $userRepository;
    private array $data, $dataAddress, $dataPhone, $dataOrder;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dataAddress = $this->setDataAddress();
        $this->dataPhone = $this->setDataPhone();
        $this->dataOrder = $this->setDataOrder();
        $this->data = $this->setDataUser();
    }

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $this->request = new EditUserRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['nome'] = $this->data['nome'];
        $this->request['email'] = $this->data['email'];
        $this->request['genero'] = $this->data['genero'];
        $this->request['ativo'] = $this->data['ativo'];

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
        $mappedItem = $editUserService->mapItem($this->dataOrder['itens'][0]['id'], $this->dataOrder['itens'][0]['ativo']);
        $mappedOrder = $editUserService->mapOrder($this->dataOrder['id'], $this->dataOrder['ativo']);
        $mappedAddress = $editUserService->mapAddress($this->dataAddress['id'], $this->dataAddress['ativo']);
        $mappedTelephone = $editUserService->mapTelephone($this->dataPhone[0]['id'], $this->dataPhone[0]['ativo']);
        $mappedUser = $editUserService->mapUser($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Item::class, $mappedItem);
        $this->assertInstanceOf(Pedido::class, $mappedOrder);
        $this->assertInstanceOf(Endereco::class, $mappedAddress);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertInstanceOf(User::class, $mappedUser);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['nome'], $this->data['nome']);
        $this->assertEquals($this->request['email'], $this->data['email']);
        $this->assertEquals($this->request['genero'], $this->data['genero']);
        $this->assertEquals($this->request['ativo'], $this->data['ativo']);
    }
}
