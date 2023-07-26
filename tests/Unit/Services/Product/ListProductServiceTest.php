<?php

namespace Tests\Unit\Services\User;

use App\DataTransferObjects\MappersDtos\ProductMapperDto;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Concretes\ListProductService;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class ListProductServiceTest extends TestCase
{
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
        $this->search = '';
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;

        $expectedResult = $this->paginationList();

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->search, $this->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);

        $result = $listProductService->listProductAll($this->pagination, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_product_all_has_paginaiton_with_search_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $this->search = Str::random(10);
        $this->pagination = new Pagination();
        $this->pagination['page'] = 1;
        $this->pagination['perPage'] = 10;

        $expectedResult = $this->paginationList();

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->search, $this->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);

        $result = $listProductService->listProductAll($this->pagination, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_product_all_no_paginaiton_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $this->search = '';
        $this->pagination = new Pagination();
        $this->pagination['page'] = null;
        $this->pagination['perPage'] = null;

        $expectedResult = $this->paginationList();

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getAll')->with($this->pagination, $this->search, $this->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);

        $result = $listProductService->listProductAll($this->pagination, $this->search, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }

    public function test_success_list_product_find_id_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $collect = [
            'id' => $this->id,
            'nome' => Str::random(10),
            'preco_custo' => rand(1, 100),
            'margem_lucro' => rand(1, 100),
            'preco_venda' => rand(1, 100),
            'codigo_barra' => Str::random(13),
            'descricao' => Str::random(50),
            'quantidade' => rand(1, 100),
            'unidade_medida' => rand(1, 100),
            'data_validade' => date('Y-m-d H:i:s'),
            'categoria_id' => rand(1, 100),
            'fornecedor_id' => rand(1, 100),
            'imagem' => [],
            'ativo' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $collection = ProductMapperDto::mapper($collect);
        $expectedResult = collect($collection);

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('getOne')->with($this->id, $this->active)
                     ->andReturn($expectedResult);
        });

        // Act
        $listProductService = new ListProductService($this->productRepository);

        $result = $listProductService->listProductFind($this->id, $this->active);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
