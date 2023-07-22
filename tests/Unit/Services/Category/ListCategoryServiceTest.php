<?php

namespace Tests\Unit\Services\Category;

use App\DataTransferObjects\MappersDtos\CategoryMapperDto;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Concretes\ListCategoryService;
use App\Support\Enums\PerfilEnum;
use App\Support\Utils\Pagination\Pagination;
use Mockery\MockInterface;
use Tests\TestCase;

class ListCategoryServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private Pagination $pagination;
    private int $id;
    private bool $active;
    private string $search;

    public function test_success_list_category_all_has_pagination_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;

        $collection = Categoria::where('ativo', '=', $this->active)->orderByDesc('id')->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = CategoryMapperDto::mapper($instance);
        endforeach;
        $expectedResult = $collection;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkCategoryIdExist')->with($this->id);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $listCategoryService->listCategoryAll($this->pagination, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertSame($result, $expectedResult);
        $this->assertEquals(count($result->toArray()), count($expectedResult->toArray()));
    }

    public function test_success_list_category_all_no_pagination_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $this->pagination = new Pagination();
        $this->pagination['page'] = null;
        $this->pagination['perPage'] = null;

        $collection = Categoria::where('ativo', '=', $this->active)->orderByDesc('id')->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = CategoryMapperDto::mapper($instance);
        endforeach;
        $expectedResult = $collection;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkCategoryIdExist')->with($this->id);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $listCategoryService->listCategoryAll($this->pagination, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertSame($result, $expectedResult);
        $this->assertEquals(count($result->toArray()), count($expectedResult->toArray()));
    }

    public function test_success_list_category_find_id_service(): void
    {
        // Arrange
        $this->id = Categoria::query()->first()->id;
        $this->active = true;
        $this->search = '%%';
        $collect = Categoria::where('ativo', $this->active)->where('id', '=', $this->id)
        ->orWhere('nome', 'like', $this->search)->get()->toArray()[0];
        $collection = CategoryMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkCategoryIdExist')->with($this->id);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $listCategoryService->listCategoryFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }

    public function test_success_list_user_category_search_name_service(): void
    {
        // Arrange
        $this->id = 0;
        $this->active = true;
        $this->search = Categoria::query()->first()->nome;
        $collect = Categoria::where('ativo', $this->active)->where('id', '=', $this->id)
        ->orWhere('nome', 'like', $this->search)->get()->toArray()[0];
        $collection = CategoryMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkCategoryIdExist')->with($this->id);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $listCategoryService->listCategoryFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }
}
