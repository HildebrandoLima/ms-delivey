<?php

namespace Tests\Unit\Services\Order;

use App\Data\Repositories\Order\Interfaces\IListFindByIdOrderRepository;
use App\Domains\Services\Order\Concretes\ListFindByIdOrderService;
use Illuminate\Http\Request;
use Mockery\MockInterface;
use Tests\TestCase;

class ListFindByIdOrderServiceTest extends TestCase
{
    private IListFindByIdOrderRepository $listFindByIdOrderRepository;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_category_find_by_id_service(): void
    {
        // Arrange
        $expectedResult = collect([]);
        $this->request = new Request(['id' => 1, 'active' => true]);

        $this->listFindByIdOrderRepository = $this->mock(IListFindByIdOrderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('listFindById')
                     ->with($this->request->id, $this->request->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listFindByIdOrderService = new ListFindByIdOrderService($this->listFindByIdOrderRepository);
        $result = $listFindByIdOrderService->listFindById($this->request);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
