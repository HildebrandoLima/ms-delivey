<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\Order\ParamsOrderRequest;
use App\Domains\Models\Item;
use App\Domains\Models\Pedido;
use App\Services\Order\Concretes\EditOrderService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditOrderServiceTest extends TestCase
{
    private ParamsOrderRequest $request;
    private IEntityRepository $orderRepository;

    public function test_success_edit_order_service(): void
    {
        // Arrange
        $order = Pedido::query()->first();
        $this->request = new ParamsOrderRequest();
        $this->request['id'] = $order->id;
        $this->request['ativo'] = $order->ativo;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

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
        $this->assertEquals($this->request['id'], $order->id);
        $this->assertEquals($this->request['ativo'], $order->ativo);
    }
}
