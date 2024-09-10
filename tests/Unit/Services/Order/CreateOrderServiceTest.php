<?php

namespace Tests\Unit\Services\Order;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Order\Concretes\CreateOrderService;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Jobs\InventoryManagementJob;
use App\Models\Item;
use App\Models\Pedido;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateOrderServiceTest extends TestCase
{
    private CreateOrderRequest $request;
    private IEntityRepository $orderRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataOrder();
    }

    public function test_success_create_order_service(): void
    {
        // Arrange
        $this->request = new CreateOrderRequest();
        $this->request['quantidadeItens'] = $this->data['quantidadeItens'];
        $this->request['total'] = $this->data['total'];
        $this->request['tipoEntrega'] = $this->data['tipoEntrega'];
        $this->request['valorEntrega'] = $this->data['valorEntrega'];
        $this->request['usuarioId'] = $this->data['usuarioId'];
        $this->request['itens'] = $this->data['itens'];

        $this->orderRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Pedido::class)->andReturn(rand(10, 10));
            $mock->shouldReceive('create')->with(Item::class)->andReturn(true);
        });

        // Act
        Queue::fake();
        $createOrderService = new CreateOrderService($this->orderRepository);
        $resultOrder = $createOrderService->createOrder($this->request);
        $resultItems = $createOrderService->createItem($this->request, $resultOrder);
        $mappedOrder = $createOrderService->mapOrder($this->request);
        $mappedItems = $createOrderService->mapItem($this->request['itens'][0], $resultOrder);
        $order = $this->request->toArray();
        unset($order['itens']);
        $itens = $this->request['itens'][0];

        // Assert
        $this->assertIsInt($resultOrder);
        $this->assertInstanceOf(Pedido::class, $mappedOrder);
        $this->assertEquals($this->request['quantidadeItens'], $this->data['quantidadeItens']);
        $this->assertEquals($this->request['total'], $this->data['total']);
        $this->assertEquals($this->request['tipoEntrega'], $this->data['tipoEntrega']);
        $this->assertEquals($this->request['valorEntrega'], $this->data['valorEntrega']);
        $this->assertEquals($this->request['usuarioId'], $this->data['usuarioId']);

        $this->assertTrue($resultItems);
        $this->assertInstanceOf(Item::class, $mappedItems);
        $this->assertIsArray($this->request['itens']);
        $this->assertEquals($itens['nome'], $this->data['itens'][0]['nome']);
        $this->assertEquals($itens['preco'], $this->data['itens'][0]['preco']);
        $this->assertEquals($itens['quantidadeItem'], $this->data['itens'][0]['quantidadeItem']);
        $this->assertEquals($itens['subTotal'], $this->data['itens'][0]['subTotal']);
        $this->assertEquals($itens['produtoId'], $this->data['itens'][0]['produtoId']);

        Queue::assertPushed(InventoryManagementJob::class, function ($items) {
            return $items;
        });

        Queue::assertPushed(EmailCreateOrderJob::class, function ($items) use ($order) {
            return $order and $items;
        });
    }
}
