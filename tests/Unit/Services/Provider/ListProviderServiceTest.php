<?php

namespace Tests\Unit\Services\User;

use App\Repositories\Abstracts\IProviderRepository;
use App\Services\Provider\Concretes\ListProviderService;
use App\Support\Enums\PerfilEnum;
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

    public function test_success_list_provider_all_has_pagination_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->search = '';
        $this->filter = true;

        $expectedResult = $this->paginationList();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(IProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with(Pagination::class, $this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);

        $result = $listProviderService->listProviderAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_provider_all_has_pagination_search_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->search = Str::random(10);
        $this->filter = true;

        $expectedResult = $this->paginationList();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(IProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with(Pagination::class, $this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);

        $result = $listProviderService->listProviderAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_provider_all_no_pagination_search_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->search = Str::random(10);
        $this->filter = true;

        $expectedResult = $this->paginationList();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(IProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with(Pagination::class, $this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);

        $result = $listProviderService->listProviderAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_provider_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->filter = true;
        $expectedResult = collect([]);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->providerRepository = $this->mock(IProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readOne')->with($this->id, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProviderService = new ListProviderService($this->providerRepository);

        $result = $listProviderService->listProviderFind($this->id, $this->filter);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
