<?php

namespace Tests\Unit\Services\Category;

use App\DataTransferObjects\MappersDtos\CategoryMapperDto;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Category\Concretes\ListCategoryService;
use App\Support\Enums\PerfilEnum;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListCategoryServiceTest extends TestCase
{
    private CategoryRepositoryInterface $categoryRepository;
    private Pagination $pagination;
    private int $id;
    private bool $active;
    private string $search;

    public function test_success_list_category_all_has_pagination_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $this->active = true;
        $this->search = '';

        $expectedResult = $this->paginationList();

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService($this->categoryRepository);

        $result = $listCategoryService->listCategoryAll($this->pagination, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_category_all_has_pagination_search_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;
        $this->active = true;
        $this->search = 'Teste';

        $expectedResult = $this->paginationList();

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService($this->categoryRepository);

        $result = $listCategoryService->listCategoryAll($this->pagination, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_category_all_no_pagination_service(): void
    {
        // Arrange
        $this->pagination = new Pagination();
        $this->pagination['page'] = null;
        $this->pagination['perPage'] = null;
        $this->active = true;
        $this->search = '';

        $expectedResult = $this->paginationList();

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService($this->categoryRepository);

        $result = $listCategoryService->listCategoryAll($this->pagination, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_category_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $collect = [
            'id' => $this->id,
            'nome' => Str::random(10),
            'ativo' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $collection = CategoryMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService($this->categoryRepository);

        $result = $listCategoryService->listCategoryFind($this->id, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
