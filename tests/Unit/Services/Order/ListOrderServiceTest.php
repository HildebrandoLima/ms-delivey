<?php

namespace Tests\Unit\Services\Order;

use App\Data\Repositories\Abstracts\IOrderRepository;
use App\Domains\Services\Order\Concretes\ListOrderService;
use App\Support\Enums\RoleEnum;
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
        $authenticate = $this->authenticate(RoleEnum::ADMIN);
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
        $orderId = rand(1, 100);
        $this->id = $orderId;
        $this->filter = true;
        $authenticate = $this->authenticate(RoleEnum::ADMIN);
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
