<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Product\Interfaces\IListAllProductRepository;
use App\Domains\Services\Product\Concretes\ListAllProductService;
use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAllProductServiceTest extends TestCase
{
    private IListAllProductRepository $listAllProductRepository;
    private IPagination $pagination;
    private ISearch $search;
    private string $searchRandom = '';
    private bool $active = true;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_product_all_has_paginaiton_service(): void
    {
        // Arrange
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();    

        $this->listAllProductRepository = $this->mock(IListAllProductRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->searchRandom, $this->active)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->searchRandom, $this->active)
                     ->andReturn(collect([]));
        });

        $request = new Request(['page' => 1, 'perPage' => 10, 'active' => true]);

        // Act
        $listAllProductService = new ListAllProductService(
            $this->listAllProductRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllProductService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_product_all_has_paginaiton_with_search_params_product_name_service(): void
    {
        // Arrange
        $this->searchRandom = Str::random(10);
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();    

        $this->listAllProductRepository = $this->mock(IListAllProductRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->searchRandom, $this->active)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->searchRandom, $this->active)
                     ->andReturn(collect([]));
        });

        $request = new Request(['page' => 1, 'perPage' => 10, 'active' => true, 'search' => $this->searchRandom]);

        // Act
        $listAllProductService = new ListAllProductService(
            $this->listAllProductRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllProductService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_product_all_has_paginaiton_with_search_params_product_category_service(): void
    {
        // Arrange
        $this->searchRandom = 10;
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();    

        $this->listAllProductRepository = $this->mock(IListAllProductRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->searchRandom, $this->active)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->searchRandom, $this->active)
                     ->andReturn(collect([]));
        });

        $request = new Request(['page' => 1, 'perPage' => 10, 'active' => true, 'search' => $this->searchRandom]);

        // Act
        $listAllProductService = new ListAllProductService(
            $this->listAllProductRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllProductService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_product_all_no_paginaiton_service(): void
    {
        // Arrange
        $this->pagination = $this->setMockPagination(false);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = collect([]);    

        $this->listAllProductRepository = $this->mock(IListAllProductRepository::class,
            function (MockInterface $mock) use ($expectedResultRepository) {
                $mock->shouldReceive('hasPagination')
                     ->with($this->searchRandom, $this->active)
                     ->andReturn($expectedResultRepository);

                $mock->shouldReceive('noPagination')
                     ->with($this->searchRandom, $this->active)
                     ->andReturn(collect([]));
        });

        $request = new Request(['page' => 1, 'perPage' => 10, 'active' => true]);

        // Act
        $listAllProductService = new ListAllProductService(
            $this->listAllProductRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllProductService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }
}
