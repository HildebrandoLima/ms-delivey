<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Order\Interfaces\IUpdateOrderRepository;
use App\Domains\Services\Order\Concretes\UpdateOrderService;
use App\Http\Requests\Order\ListFindByIdOrderRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateOrderServiceTest extends TestCase
{
    private ListFindByIdOrderRequest $request;
    private IUpdateOrderRepository $updateOrderRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataOrder();
    }

    public function test_success_edit_order_service(): void
    {
        // Arrange
        $this->request = new ListFindByIdOrderRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['active'] = $this->data['ativo'];

        $this->updateOrderRepository = $this->mock(IUpdateOrderRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $editOrderService = new UpdateOrderService($this->updateOrderRepository);
        $result = $editOrderService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['active'], $this->data['ativo']);
    }
}
