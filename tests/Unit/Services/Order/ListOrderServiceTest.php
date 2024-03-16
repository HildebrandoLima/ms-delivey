<?php

namespace Tests\Unit\Services\Order;

use App\Domains\Models\Pedido;
use App\Repositories\Abstracts\IOrderRepository;
use App\Services\Order\Concretes\ListOrderService;
use App\Support\Enums\PerfilEnum;
use App\Support\Utils\Pagination\Pagination;
use Mockery\MockInterface;
use Tests\TestCase;

class ListOrderServiceTest extends TestCase
{
    private IOrderRepository $orderRepository;
    private Pagination $pagination;
    private int $id;
    private bool $filter;
    private string $search;

    public function test_success_list_order_all_service(): void
    {
        // Arrange
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $this->id = $authenticate['userId'];
        $this->filter = true;
        $this->search = '';
        $expectedResult = $this->paginationList();

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);        

        $this->orderRepository = $this->mock(IOrderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with($this->search, $this->id, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listOrderService = new ListOrderService($this->orderRepository);
        $result = $listOrderService->listOrderAll($this->search, $this->id, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_order_find_service(): void
    {
        // Arrange
        $orderId = Pedido::query()->first()->id;
        $this->id = $orderId;
        $this->filter = true;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $expectedResult = collect([]);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->orderRepository = $this->mock(IOrderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readOne')->with($this->id, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listOrderService = new ListOrderService($this->orderRepository);
        $result = $listOrderService->listOrderFind($this->id, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }
}
