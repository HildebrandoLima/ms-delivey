<?php

namespace Tests\Unit\Services\Provider;

use App\Data\Repositories\Provider\Interfaces\IListAllProviderRepository;
use App\Domains\Services\Provider\Concretes\ListAllProviderService;
use App\Support\Utils\Pagination\Interface\IPagination;
use App\Support\Utils\Params\Interface\ISearch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListAllProviderServiceTest extends TestCase
{
    private IListAllProviderRepository $listAllProviderRepository;
    private IPagination $pagination;
    private ISearch $search;
    private string $searchRandom = '';
    private bool $active = true;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_provider_all_has_pagination_service(): void
    {
        // Arrange
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();

        $this->listAllProviderRepository = $this->mock(IListAllProviderRepository::class,
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
        $listAllProviderService = new ListAllProviderService
        (
            $this->listAllProviderRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllProviderService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_provider_all_has_pagination_search_service(): void
    {
        // Arrange
        $this->searchRandom = Str::random(10);
        $this->pagination = $this->setMockPagination(true);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = $this->paginatedList();

        $this->listAllProviderRepository = $this->mock(IListAllProviderRepository::class,
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
        $listAllProviderService = new ListAllProviderService
        (
            $this->listAllProviderRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllProviderService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }

    public function test_success_list_provider_all_no_pagination_search_service(): void
    {
        $this->pagination = $this->setMockPagination(false);
        $this->search = $this->setMockSearch($this->searchRandom);

        $expectedResultRepository = $this->lengthAwarePaginator();
        $expectedResultService = collect([]);

        $this->listAllProviderRepository = $this->mock(IListAllProviderRepository::class,
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
        $listAllProviderService = new ListAllProviderService
        (
            $this->listAllProviderRepository,
            $this->pagination,
            $this->search
        );
        $result = $listAllProviderService->listAll($request);

        // Assert
        $this->assertEquals($expectedResultService, $result);
    }
}
