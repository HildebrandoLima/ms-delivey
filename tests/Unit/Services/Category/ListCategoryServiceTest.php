<?php

namespace Tests\Unit\Services\Category;

use App\DataTransferObjects\MappersDtos\CategoryMapperDto;
use App\Models\Categoria;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Category\Concretes\ListCategoryService;
use App\Support\Utils\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class ListCategoryServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private CategoryRepositoryInterface $categoryRepository;

    public function test_success_list_category_all_service(): void
    {
        // Arrange
        $id = rand(1, 100);
        $active = true;
        $collection = Categoria::where('ativo', '=', $active)->orderByDesc('id')->get();
        foreach ($collection->toArray() as $key => $instance):
            $collection[$key] = CategoryMapperDto::mapper($instance);
        endforeach;
        $expectedResult = $collection;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkCategoryIdExist')->with($id);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $active) {
                $mock->shouldReceive('getAll')->with($active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $listCategoryService->listCategoryAll($active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertSame($result, $expectedResult);
        $this->assertEquals(count($result->toArray()), count($expectedResult->toArray()));
    }

    public function test_success_list_category_find_id_service(): void
    {
        // Arrange
        $id = Categoria::query()->first()->id;
        $active = true;
        $search = '%%';
        $collect = Categoria::where('ativo', $active)->where('id', '=', $id)->orWhere('nome', 'like', $search)->get()->toArray()[0];
        $collection = CategoryMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkCategoryIdExist')->with($id);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $id, $active) {
                $mock->shouldReceive('getOne')->with($id, '', $active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $listCategoryService->listCategoryFind($id, '', $active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }

    public function test_success_list_user_category_search_name_service(): void
    {
        // Arrange
        $id = 0;
        $active = true;
        $search = Categoria::query()->first()->nome;
        $collect = Categoria::where('ativo', $active)->where('id', '=', $id)->orWhere('nome', 'like', $search)->get()->toArray()[0];
        $collection = CategoryMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkCategoryIdExist')->with($id);
        });

        $this->categoryRepository = $this->mock(CategoryRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult, $id, $active) {
                $mock->shouldReceive('getOne')->with($id, '', $active)
                ->andReturn($expectedResult);
        });

        // Act
        $listCategoryService = new ListCategoryService
        (
            $this->checkEntityRepository,
            $this->categoryRepository
        );

        $result = $listCategoryService->listCategoryFind($id, '', $active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }
}
