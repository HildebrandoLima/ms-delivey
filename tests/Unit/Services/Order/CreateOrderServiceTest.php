<?php

namespace Tests\Unit\Services\Order;

use App\Http\Requests\Order\OrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Services\Order\Concretes\CreateOrderService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateOrderServiceTest extends TestCase
{
    private OrderRequest $request;
    private OrderRepositoryInterface $orderRepository;
    private ItemRepositoryInterface $itemRepository;
    private array $unitMeasure = array('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX');
    private int $id = 0;

    public function test_success_create_order_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->unitMeasure);
        $this->id = rand(1, 100);
        $this->request = new OrderRequest();
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

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->orderRepository = $this->mock(OrderRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Pedido::class)->andReturn($this->id);
        });

        $this->itemRepository = $this->mock(ItemRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Item::class)->andReturn(true);
        });

        // Act
        $createOrderService = new CreateOrderService
        (
            $this->orderRepository,
            $this->itemRepository
        );

        $result = $createOrderService->createOrder($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
