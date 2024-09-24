<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Category\Interfaces\IListFindByIdCategoryRepository;
use App\Domains\Services\Category\Concretes\ListFindByIdCategoryService;
use Illuminate\Http\Request;
use Mockery\MockInterface;
use Tests\TestCase;

class ListFindByIdCategoryServiceTest extends TestCase
{
    private IListFindByIdCategoryRepository $listFindByIdCategoryRepository;
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

        $this->listFindByIdCategoryRepository = $this->mock(IListFindByIdCategoryRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('listFindById')
                     ->with($this->request->id, $this->request->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listFindByIdCategoryService = new ListFindByIdCategoryService($this->listFindByIdCategoryRepository);
        $result = $listFindByIdCategoryService->listFindById($this->request);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
