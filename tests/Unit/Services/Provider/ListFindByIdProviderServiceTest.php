<?php

namespace Tests\Unit\Services\Provider;

use App\Data\Repositories\Provider\Interfaces\IListFindByIdProviderRepository;
use App\Domains\Services\Provider\Concretes\ListFindByIdProviderService;
use Illuminate\Http\Request;
use Mockery\MockInterface;
use Tests\TestCase;

class ListFindByIdProviderServiceTest extends TestCase
{
    private IListFindByIdProviderRepository $listFindByIdProviderRepository;
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

        $this->listFindByIdProviderRepository = $this->mock(IListFindByIdProviderRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('listFindById')
                     ->with($this->request->id, $this->request->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listFindByIdProviderService = new ListFindByIdProviderService($this->listFindByIdProviderRepository);
        $result = $listFindByIdProviderService->listFindById($this->request);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
