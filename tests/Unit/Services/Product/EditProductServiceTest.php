<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Product\Concretes\EditProductService;
use App\Http\Requests\Product\EditProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use Mockery\MockInterface;
use Tests\TestCase;

class EditProductServiceTest extends TestCase
{
    private EditProductRequest $request;
    private IEntityRepository $productRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataProduct();
    }

    public function test_success_edit_product_service(): void
    {
        // Arrange
        $this->request = new EditProductRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['nome'] = $this->data['nome'];
        $this->request['precoCusto'] = $this->data['precoCusto'];
        $this->request['precoVenda'] = $this->data['precoVenda'];
        $this->request['codigoBarra'] = $this->data['codigoBarra'];
        $this->request['descricao'] = $this->data['descricao'];
        $this->request['quantidade'] = $this->data['quantidade'];
        $this->request['unidadeMedida'] = $this->data['unidadeMedida'];
        $this->request['dataValidade'] = $this->data['dataValidade'];
        $this->request['categoriaId'] = $this->data['categoriaId'];
        $this->request['fornecedorId'] = $this->data['fornecedorId'];
        $this->request['ativo'] = $this->data['ativo'];

        $this->productRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('read')->with(Imagem::class, $this->request['id'])->andReturn(collect([]));
            $mock->shouldReceive('update')->with(Produto::class)->andReturn(true);
        });

        // Act
        $editProductSerice = new EditProductService($this->productRepository);
        $resultProduct = $editProductSerice->editProduct($this->request);
        $mappedImage = $editProductSerice->mapImage($this->request['id'], $this->request['ativo']);
        $mappedProduct = $editProductSerice->mapProduct($this->request);

        // Assert
        $this->assertTrue($resultProduct);
        $this->assertInstanceOf(Produto::class, $mappedProduct);
        $this->assertInstanceOf(Imagem::class, $mappedImage);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['nome'], $this->data['nome']);
        $this->assertEquals($this->request['precoCusto'], $this->data['precoCusto']);
        $this->assertEquals($this->request['precoVenda'], $this->data['precoVenda']);
        $this->assertEquals($this->request['codigoBarra'], $this->data['codigoBarra']);
        $this->assertEquals($this->request['descricao'], $this->data['descricao']);
        $this->assertEquals($this->request['quantidade'], $this->data['quantidade']);
        $this->assertEquals($this->request['unidadeMedida'], $this->data['unidadeMedida']);
        $this->assertEquals($this->request['dataValidade'], $this->data['dataValidade']);
        $this->assertEquals($this->request['categoriaId'], $this->data['categoriaId']);
        $this->assertEquals($this->request['fornecedorId'], $this->data['fornecedorId']);
        $this->assertEquals($this->request['ativo'], $this->data['ativo']);
    }
}
