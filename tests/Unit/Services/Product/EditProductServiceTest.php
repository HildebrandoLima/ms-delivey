<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Models\Imagem;
use App\Domains\Models\Produto;
use App\Domains\Services\Product\Concretes\EditProductService;
use App\Http\Requests\Product\EditProductRequest;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditProductServiceTest extends TestCase
{
    private EditProductRequest $request;
    private IEntityRepository $productRepository;

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_edit_product_service(): void
    {
        // Arrange
        $editedProduct = Produto::query()->first();
        $this->request = new EditProductRequest();
        $this->request['id'] = $editedProduct->id;
        $this->request['nome'] = $editedProduct->nome;
        $this->request['precoCusto'] = $editedProduct->preco_custo;
        $this->request['precoVenda'] = $editedProduct->preco_venda;
        $this->request['codigoBarra'] = $editedProduct->codigo_barra;
        $this->request['descricao'] = $editedProduct->descricao;
        $this->request['quantidade'] = $editedProduct->quantidade;
        $this->request['unidadeMedida'] = $editedProduct->unidade_medida;
        $this->request['dataValidade'] = $editedProduct->data_validade;
        $this->request['categoriaId'] = $editedProduct->categoria_id;
        $this->request['fornecedorId'] = $editedProduct->fornecedor_id;
        $this->request['ativo'] = $editedProduct->ativo;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->productRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('read')->with(Imagem::class, $this->request['id'])->andReturn(collect([]));
            $mock->shouldReceive('update')->with(Produto::class)->andReturn(true);
        });

        // Act
        $editProductSerice = new EditProductService($this->productRepository);
        $resultProduct = $editProductSerice->editProduct($this->request);
        $mappedImage = $editProductSerice->mapImage($editedProduct->id, $editedProduct->ativo);
        $mappedProduct = $editProductSerice->mapProduct($this->request);

        // Assert
        $this->assertTrue($resultProduct);
        $this->assertInstanceOf(Produto::class, $mappedProduct);
        $this->assertInstanceOf(Imagem::class, $mappedImage);
        $this->assertEquals($this->request['id'], $editedProduct->id);
        $this->assertEquals($this->request['nome'], $editedProduct->nome);
        $this->assertEquals($this->request['precoCusto'], $editedProduct->preco_custo);
        $this->assertEquals($this->request['precoVenda'], $editedProduct->preco_venda);
        $this->assertEquals($this->request['codigoBarra'], $editedProduct->codigo_barra);
        $this->assertEquals($this->request['descricao'], $editedProduct->descricao);
        $this->assertEquals($this->request['quantidade'], $editedProduct->quantidade);
        $this->assertEquals($this->request['unidadeMedida'], $editedProduct->unidade_medida);
        $this->assertEquals($this->request['dataValidade'], $editedProduct->data_validade);
        $this->assertEquals($this->request['categoriaId'], $editedProduct->categoria_id);
        $this->assertEquals($this->request['fornecedorId'], $editedProduct->fornecedor_id);
    }
}
