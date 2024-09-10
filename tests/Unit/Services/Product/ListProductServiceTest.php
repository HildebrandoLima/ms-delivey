<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Abstracts\IProductRepository;
use App\Domains\Services\Product\Concretes\ListProductService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListProductServiceTest extends TestCase
{
    private IProductRepository $productRepository;
    private Pagination $pagination;
    private int $id;
    private bool $filter;
    private string|int $search;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_product_all_has_paginaiton_service(): void
    {
        // Arrange
        $this->filter = true;
        $this->search = '';
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $expectedResult = $this->paginationList();

        $this->productRepository = $this->mock(IProductRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('hasPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);

                $mock->shouldReceive('noPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);
        $result = $listProductService->listProductAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_product_all_has_paginaiton_with_search_params_product_name_service(): void
    {
        // Arrange
        $this->filter = true;
        $this->search = Str::random(10);
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $expectedResult = $this->paginationList();

        $this->productRepository = $this->mock(IProductRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('hasPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);

                $mock->shouldReceive('noPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);
        $result = $listProductService->listProductAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_product_all_has_paginaiton_with_search_params_product_category_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->filter = true;
        $this->search = rand(1, 10);
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $expectedResult = $this->paginationList();

        $this->productRepository = $this->mock(IProductRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('hasPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);

                $mock->shouldReceive('noPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);
        $result = $listProductService->listProductAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_product_all_no_paginaiton_service(): void
    {
        // Arrange
        $this->filter = true;
        $this->search = '';
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $expectedResult = $this->paginationList();

        $this->productRepository = $this->mock(IProductRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('hasPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);

                $mock->shouldReceive('noPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);
        $result = $listProductService->listProductAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_product_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->filter = true;
        $expectedResult = collect([]);

        $this->productRepository = $this->mock(IProductRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readOne')->with($this->id, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);
        $result = $listProductService->listProductFind($this->id, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }
}
