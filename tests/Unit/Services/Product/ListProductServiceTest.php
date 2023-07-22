<?php

namespace Tests\Unit\Services\User;

use App\DataTransferObjects\MappersDtos\ProductMapperDto;
use App\Models\Produto;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Concretes\ListProductService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Pagination\PaginationList;
use Mockery\MockInterface;
use Tests\TestCase;

class ListProductServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProductRepositoryInterface $productRepository;
    private Pagination $pagination;
    private int $id;
    private bool $active;
    private string $search;

    public function test_success_list_product_all_has_paginaiton_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;

        $collection = Produto::query()->with('imagem')->where('produto.ativo', '=', $this->active)->orderByDesc('produto.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance->toArray());
        endforeach;
        $expectedResult = PaginationList::createFromPagination($collection);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkProductIdExist')->with($this->id);
        });

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductServiceTest = new ListProductService
        (
            $this->checkEntityRepository,
            $this->productRepository
        );

        $result = $listProductServiceTest->listProductAll($this->pagination, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray()['list']);
        $this->assertIsArray($expectedResult->toArray()['list']);
        $this->assertEquals(count($result->toArray()['list']), count($expectedResult->toArray()['list']));
    }

    public function test_success_list_product_all_no_paginaiton_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $this->pagination = new Pagination();
        $this->pagination['page'] = null;
        $this->pagination['perPage'] = null;

        $collection = Produto::query()->with('imagem')->where('produto.ativo', '=', $this->active)->orderByDesc('produto.id')->paginate(10);
        foreach ($collection->items() as $key => $instance):
            $collection[$key] = ProductMapperDto::mapper($instance->toArray());
        endforeach;
        $expectedResult = PaginationList::createFromPagination($collection);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkProductIdExist')->with($this->id);
        });

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductServiceTest = new ListProductService
        (
            $this->checkEntityRepository,
            $this->productRepository
        );

        $result = $listProductServiceTest->listProductAll($this->pagination, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray()['list']);
        $this->assertIsArray($expectedResult->toArray()['list']);
        $this->assertEquals(count($result->toArray()['list']), count($expectedResult->toArray()['list']));
    }

    public function test_success_list_product_find_id_service(): void
    {
        // Arrange
        $this->id = Produto::query()->first()->id;
        $this->active = true;
        $this->search = '%%';
        $collect = Produto::query()->with('imagem')->where('produto.ativo', '=', $this->active)
        ->where('produto.id', '=', $this->id)->orWhere('produto.nome', 'like', $this->search)->get()->toArray()[0];
        $collection = ProductMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkProductIdExist')->with($this->id);
        });

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductServiceTest = new ListProductService
        (
            $this->checkEntityRepository,
            $this->productRepository
        );

        $result = $listProductServiceTest->listProductFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }

    public function test_success_list_product_find_search_service(): void
    {
        // Arrange
        $this->id = 0;
        $this->active = true;
        $this->search = Produto::query()->first()->nome;
        $collect = Produto::query()->with('imagem')->where('produto.ativo', '=', $this->active)
        ->where('produto.id', '=', $this->id)->orWhere('produto.nome', 'like', $this->search)->get()->toArray()[0];
        $collection = ProductMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkProductIdExist')->with($this->id);
        });

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->search, $this->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductServiceTest = new ListProductService
        (
            $this->checkEntityRepository,
            $this->productRepository
        );

        $result = $listProductServiceTest->listProductFind($this->id, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
    }
}
