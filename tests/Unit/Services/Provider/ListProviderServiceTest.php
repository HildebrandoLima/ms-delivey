<?php

namespace Tests\Unit\Services\Provider;

use App\Data\Repositories\Abstracts\IProviderRepository;
use App\Domains\Services\Provider\Concretes\ListProviderService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListProviderServiceTest extends TestCase
{
    private IProviderRepository $providerRepository;
    private Pagination $pagination;
    private int $id;
    private bool $filter;
    private string $search;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_list_provider_all_has_pagination_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $this->search = '';
        $this->filter = true;
        $expectedResult = $this->paginationList();

        $this->providerRepository = $this->mock(IProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('hasPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);

                $mock->shouldReceive('noPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);
        $result = $listProviderService->listProviderAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_provider_all_has_pagination_search_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $this->search = Str::random(10);
        $this->filter = true;
        $expectedResult = $this->paginationList();

        $this->providerRepository = $this->mock(IProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('hasPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);

                $mock->shouldReceive('noPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);
        $result = $listProviderService->listProviderAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_provider_all_no_pagination_search_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->search = Str::random(10);
        $this->filter = true;
        $expectedResult = $this->paginationList();

        $this->providerRepository = $this->mock(IProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('hasPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);

                $mock->shouldReceive('noPagination')->with($this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);
        $result = $listProviderService->listProviderAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_provider_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->filter = true;
        $expectedResult = collect([]);

        $this->providerRepository = $this->mock(IProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readOne')->with($this->id, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);
        $result = $listProviderService->listProviderFind($this->id, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }
}
