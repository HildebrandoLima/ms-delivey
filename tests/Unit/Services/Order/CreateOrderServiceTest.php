<?php

namespace Tests\Unit\Services\Order;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Jobs\InventoryManagementJob;
use App\Domains\Models\Item;
use App\Domains\Models\Pedido;
use App\Services\Order\Concretes\CreateOrderService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateOrderServiceTest extends TestCase
{
    private CreateOrderRequest $request;
    private IEntityRepository $orderRepository;

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_create_order_service(): void
    {
        // Arrange
        $createdOrder = Pedido::query()->first();
        $createdItems = Item::query()->where('pedido_id', '=', $createdOrder->id)->first();
        $this->request = new CreateOrderRequest();
        $this->request['quantidadeItens'] = $createdOrder->quantidade_itens;
        $this->request['total'] = $createdOrder->total;
        $this->request['tipoEntrega'] = $createdOrder->tipo_entrega;
        $this->request['valorEntrega'] = $createdOrder->valor_entrega;
        $this->request['usuarioId'] = $createdOrder->usuario_id;
        $this->request['itens'] = [
            [
                'nome' => $createdItems->nome,
                'preco' => $createdItems->preco,
                'quantidadeItem' => $createdItems->quantidade_item,
                'subTotal' => $createdItems->sub_total,
                'produtoId' => $createdItems->produto_id,
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
        $this->assertEquals($this->request['quantidadeItens'], $createdOrder->quantidade_itens);
        $this->assertEquals($this->request['total'], $createdOrder->total);
        $this->assertEquals($this->request['tipoEntrega'], $createdOrder->tipo_entrega);
        $this->assertEquals($this->request['valorEntrega'], $createdOrder->valor_entrega);
        $this->assertEquals($this->request['usuarioId'], $createdOrder->usuario_id);

        $this->assertTrue($resultItems);
        $this->assertInstanceOf(Item::class, $mappedItems);
        $this->assertIsArray($this->request['itens']);
        $this->assertEquals($itens['nome'], $createdItems->nome);
        $this->assertEquals($itens['preco'], $createdItems->preco);
        $this->assertEquals($itens['quantidadeItem'], $createdItems->quantidade_item);
        $this->assertEquals($itens['subTotal'], $createdItems->sub_total);
        $this->assertEquals($itens['produtoId'], $createdItems->produto_id);

        Queue::assertPushed(InventoryManagementJob::class, function ($items) {
            return $items;
        });

        Queue::assertPushed(EmailCreateOrderJob::class, function ($items) use ($order) {
            return $order and $items;
        });
    }
}
