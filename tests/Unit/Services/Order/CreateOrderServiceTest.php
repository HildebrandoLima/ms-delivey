<?php

namespace Tests\Unit\Services\Order;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Order\Concretes\CreateOrderService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;
use Illuminate\Support\Str;

class CreateOrderServiceTest extends TestCase
{
    private CreateOrderRequest $request;
    private IEntityRepository $orderRepository;

    public function test_success_create_order_service(): void
    {
        // Arrange
        $typeDelivery = array('Expresso', 'Correio', 'Retirada');
        $randKeys = array_rand($typeDelivery);
        $this->request = new CreateOrderRequest();
        $this->request['quantidadeItens'] = 1;
        $this->request['total'] = rand(1, 100);
        $this->request['tipoentrega'] = $typeDelivery[$randKeys];
        $this->request['valorEntrega'] = 3.5;
        $this->request['usuarioId'] = rand(1, 100);
        $this->request['ativo'] = true;
        $this->request['itens'] = [
            [
                'nome' => Str::random(30),
                'preco' => 15.30,
                'quantidadeItem' => 1,
                'subTotal' => 15.30,
                'produtoId' => rand(1, 100),
                'ativo' => true,
            ]
        ];

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->orderRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Pedido::class)->andReturn(rand(10, 10));
            $mock->shouldReceive('create')->with(Item::class)->andReturn(true);
        });

        // Act
        $createOrderService = new CreateOrderService($this->orderRepository);

        $result = $createOrderService->createOrder($this->request);

        // Assert
        $this->assertIsInt($result);
    }
}
