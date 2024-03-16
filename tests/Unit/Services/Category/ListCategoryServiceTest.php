<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Abstracts\ICategoryRepository;
use App\Domains\Services\Category\Concretes\ListCategoryService;
use App\Support\Enums\PerfilEnum;
use App\Support\Utils\Pagination\Pagination;
use Mockery\MockInterface;
use Tests\TestCase;

class ListCategoryServiceTest extends TestCase
{
    private ICategoryRepository $categoryRepository;
    private Pagination $pagination;
    private int $id;
    private bool $filter;
    private string $search;

    public function test_success_list_category_all_has_pagination_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $this->filter = true;
        $this->search = '';
        $expectedResult = $this->paginationList();

        $this->categoryRepository = $this->mock(ICategoryRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with(Pagination::class, $this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService($this->categoryRepository);
        $result = $listCategoryService->listCategoryAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_category_all_has_pagination_search_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $this->filter = true;
        $this->search = 'Teste';
        $expectedResult = $this->paginationList();

        $this->categoryRepository = $this->mock(ICategoryRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with(Pagination::class, $this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService($this->categoryRepository);
        $result = $listCategoryService->listCategoryAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_category_all_no_pagination_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->filter = true;
        $this->search = '';
        $expectedResult = $this->paginationList();

        $this->categoryRepository = $this->mock(ICategoryRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readAll')->with(Pagination::class, $this->search, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService($this->categoryRepository);
        $result = $listCategoryService->listCategoryAll($this->pagination, $this->search, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function test_success_list_category_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->filter = true;
        $expectedResult = collect([]);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->categoryRepository = $this->mock(ICategoryRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('readOne')->with($this->id, $this->filter)
                     ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService($this->categoryRepository);
        $result = $listCategoryService->listCategoryFind($this->id, $this->filter);

        // Assert
        $this->assertSame($expectedResult, $result);
    }
}
