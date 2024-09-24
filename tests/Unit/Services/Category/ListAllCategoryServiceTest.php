<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Category\Interfaces\IListAllCategoryRepository;
use App\Domains\Services\Category\Concretes\ListAllCategoryService;
use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAllCategoryServiceTest extends TestCase
{
    private IListAllCategoryRepository $listAllCategoryRepository;
    private IPagination $pagination;
    private ISearch $search;
    private string $searchRandom = '';
    private bool $active = true;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_category_all_has_pagination_service(): void
    {
        // Arrange
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();

        $this->listAllCategoryRepository = $this->mock(IListAllCategoryRepository::class,
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
        $listAllCategoryService = new ListAllCategoryService
        (
            $this->listAllCategoryRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllCategoryService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_category_all_has_pagination_search_service(): void
    {
        // Arrange
        $this->searchRandom = Str::random(10);
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();

        $this->listAllCategoryRepository = $this->mock(IListAllCategoryRepository::class,
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
        $listCategoryService = new ListAllCategoryService
        (
            $this->listAllCategoryRepository,
            $this->pagination,
            $this->search
        );
        $result = $listCategoryService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_category_all_no_pagination_service(): void
    {
        // Arrange
        $this->pagination = $this->setMockPagination(false);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = collect([]);

        $this->listAllCategoryRepository = $this->mock(IListAllCategoryRepository::class,
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
        $listCategoryService = new ListAllCategoryService
        (
            $this->listAllCategoryRepository,
            $this->pagination,
            $this->search
        );
        $result = $listCategoryService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }
}
