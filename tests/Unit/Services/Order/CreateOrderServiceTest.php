<?php

namespace Tests\Unit\Services\Order;

use App\Data\Repositories\Order\Interfaces\ICreateOrderRepository;
use App\Domains\Services\Order\Concretes\CreateOrderService;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Jobs\EmailCreateOrderJob;
use App\Jobs\InventoryManagementJob;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateOrderServiceTest extends TestCase
{
    private CreateOrderRequest $request;
    private ICreateOrderRepository $createOrderRepository;
    private array $data = [];
    private array $order = [];
    private array $itens = [];

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

        $this->order = $this->order = [
            'id' => $this->data['id'],
            'quantidadeItens' => $this->data['quantidadeItens'],
            'total' => $this->data['total'],
            'tipoEntrega' => $this->data['tipoEntrega'],
            'valorEntrega' => $this->data['valorEntrega'],
            'usuarioId' => $this->data['usuarioId']
        ];

        $this->createOrderRepository = $this->mock(ICreateOrderRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn($this->order);
        });

        // Act
        Queue::fake();
        $createOrderService = new CreateOrderService($this->createOrderRepository);
        $result = $createOrderService->create($this->request);
        $this->itens = $this->request['itens'][0];

        // Assert
        $this->assertIsInt($result);
        $this->assertEquals($this->order['id'], $result);
        $this->assertEquals($this->request['quantidadeItens'], $this->data['quantidadeItens']);
        $this->assertEquals($this->request['total'], $this->data['total']);
        $this->assertEquals($this->request['tipoEntrega'], $this->data['tipoEntrega']);
        $this->assertEquals($this->request['valorEntrega'], $this->data['valorEntrega']);
        $this->assertEquals($this->request['usuarioId'], $this->data['usuarioId']);

        $this->assertIsArray($this->request['itens']);
        $this->assertEquals($this->itens['nome'], $this->data['itens'][0]['nome']);
        $this->assertEquals($this->itens['preco'], $this->data['itens'][0]['preco']);
        $this->assertEquals($this->itens['quantidadeItem'], $this->data['itens'][0]['quantidadeItem']);
        $this->assertEquals($this->itens['subTotal'], $this->data['itens'][0]['subTotal']);
        $this->assertEquals($this->itens['produtoId'], $this->data['itens'][0]['produtoId']);

        Queue::assertPushed(InventoryManagementJob::class,
            function () {
                return $this->itens;
        });

        Queue::assertPushed(EmailCreateOrderJob::class,
            function () {
                return $this->order and $this->itens;
        });
    }
}
