<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\ProductRequest;
use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Concretes\EditProductService;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class EditProductServiceTest extends TestCase
{
    private ProductRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private ProductRepositoryInterface $productRepository;
    private array $unitMeasure = array('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX');
    private int $id;

    public function test_success_edit_product_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->unitMeasure);
        $this->id = rand(1, 100);
        $this->request = new ProductRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['precoCusto'] = 15.30;
        $this->request['precoVenda'] = 20.0;
        $this->request['codigoBarra'] = Str::random(13);
        $this->request['descricao'] = Str::random(30);
        $this->request['quantidade'] = rand(10, 50);
        $this->request['unidadeMedida'] = $this->unitMeasure[$rand_keys];
        $this->request['dataValidade'] = date('Y-m-d H:i:s');
        $this->request['categoriaId'] = Categoria::query()->first()->id;
        $this->request['fornecedorId'] = Fornecedor::query()->first()->id;
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('checkProviderIdExist')->with($this->request['fornecedorId']);
        });

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('update')->with($this->id, Produto::class)->andReturn(true);
        });

        // Act
        $editProductSerice = new EditProductService
        (
            $this->checkEntityRepository,
            $this->productRepository
        );

        $result = $editProductSerice->editProduct($this->id, $this->request);

        // Assert
        $this->assertTrue($result);
    }
}
