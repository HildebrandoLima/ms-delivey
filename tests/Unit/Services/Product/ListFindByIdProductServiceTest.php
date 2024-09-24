<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Product\Interfaces\IListFindByIdProductRepository;
use App\Domains\Services\Product\Concretes\ListFindByIdProductService;
use Illuminate\Http\Request;
use Mockery\MockInterface;
use Tests\TestCase;

class ListFindByIdProductServiceTest extends TestCase
{
    private IListFindByIdProductRepository $listFindByIdProductRepository;
    private Request $request;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_product_find_by_id_service(): void
    {
        // Arrange
        $expectedResult = collect([]);
        $this->request = new Request(['id' => 1, 'active' => true]);

        $this->listFindByIdProductRepository = $this->mock(IListFindByIdProductRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('listFindById')
                     ->with($this->request->id, $this->request->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listFindByIdProductService = new ListFindByIdProductService($this->listFindByIdProductRepository);
        $result = $listFindByIdProductService->listFindById($this->request);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
