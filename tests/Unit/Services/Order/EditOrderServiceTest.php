<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Order\Concretes\EditOrderService;
use App\Http\Requests\Order\ParamsOrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use Mockery\MockInterface;
use Tests\TestCase;

class EditOrderServiceTest extends TestCase
{
    private ParamsOrderRequest $request;
    private IEntityRepository $orderRepository;    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataOrder();
    }

    public function test_success_edit_order_service(): void
    {
        // Arrange
        $this->request = new ParamsOrderRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['ativo'] = $this->data['ativo'];

        $this->orderRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('read')->with(Item::class, $this->request['id'])->andReturn(collect([]));
            $mock->shouldReceive('update')->with(Pedido::class)->andReturn(true);
            $mock->shouldReceive('update')->with(Item::class)->andReturn(true);
        });

        // Act
        $editOrderService = new EditOrderService($this->orderRepository);
        $result = $editOrderService->editOrder($this->request);
        $mappedItems = $editOrderService->mapItem($this->request['id'], true);
        $mappedOrder = $editOrderService->mapOrder($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Item::class, $mappedItems);
        $this->assertInstanceOf(Pedido::class, $mappedOrder);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['ativo'], $this->data['ativo']);
    }
}
