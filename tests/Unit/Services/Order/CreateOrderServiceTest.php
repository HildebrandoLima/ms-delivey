<?php

namespace Tests\Unit\Services\Order;

use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Order\Concretes\CreateOrderService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateOrderServiceTest extends TestCase
{
    private CreateOrderRequest $request;
    private IEntityRepository $orderRepository;
    private array $unitMeasure = array('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX');

    public function test_success_create_order_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->unitMeasure);
        $this->request = new CreateOrderRequest();
        $this->request['quantidadeItens'] = 1;
        $this->request['total'] = rand(1, 100);
        $this->request['entrega'] = 3.5;
        $this->request['usuarioId'] = rand(1, 100);
        $this->request['ativo'] = true;
        $this->request['itens'] = [
            [
                'nome' => Str::random(10),
                'preco' => rand(1, 100),
                'codigoBarra' => Str::random(13),
                'quantidadeItem' => 2,
                'subTotal' => rand(1, 100),
                'unidadeMedida' => $this->unitMeasure[$rand_keys],
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
            $mock->shouldReceive('create')->with(Pedido::class)->andReturn(true);
            $mock->shouldReceive('create')->with(Item::class)->andReturn(true);
        });

        // Act
        $createOrderService = new CreateOrderService($this->orderRepository);

        $result = $createOrderService->createOrder($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
