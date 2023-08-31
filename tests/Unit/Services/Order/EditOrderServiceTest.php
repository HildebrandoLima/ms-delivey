<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\Order\ParamsOrderRequest;
use App\Models\Item;
use App\Models\Pedido;
use App\Repositories\Abstracts\IEntityRepository;
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
        $this->request = new ParamsOrderRequest();
        $this->request['id'] = rand(1, 100);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->orderRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('read')->with(Item::class, $this->request['id'])->andReturn(collect([]));
            $mock->shouldReceive('update')->with(Pedido::class)->andReturn(true);
        });

        // Act
        $editOrderService = new EditOrderService($this->orderRepository);

        $result = $editOrderService->editOrder($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
