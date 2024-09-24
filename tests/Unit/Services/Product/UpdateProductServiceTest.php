<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Product\Interfaces\IUpdateProductRepository;
use App\Domains\Services\Product\Concretes\UpdateProductService;
use App\Http\Requests\Product\UpdateProductRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateProductServiceTest extends TestCase
{
    private UpdateProductRequest $request;
    private IUpdateProductRepository $updateProductRepository;
    private array $data = [];
    private array $product = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataProduct();
    }

    public function test_success_edit_product_service(): void
    {
        // Arrange
        $this->request = new UpdateProductRequest();
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

        $this->product = [
            'nome' => $this->data['nome'],
            'precoCusto' => $this->data['precoCusto'],
            'precoVenda' => $this->data['precoVenda'],
            'margemLucro' => $this->data['precoVenda'] - $this->data['precoCusto'],
            'codigoBarra' => $this->data['codigoBarra'],
            'descricao' => $this->data['descricao'],
            'quantidade' => $this->data['quantidade'],
            'unidadeMedida' => $this->data['unidadeMedida'],
            'dataValidade' => $this->data['dataValidade'],
            'categoriaId' => $this->data['categoriaId'],
            'fornecedorId' => $this->data['fornecedorId']
        ];
    
        $this->updateProductRepository = $this->mock(IUpdateProductRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->withArgs(function() {
                        return
                            isset($this->product['nome']) &&
                            isset($this->product['precoCusto']) &&
                            isset($this->product['precoVenda']) &&
                            isset($this->product['codigoBarra']) &&
                            isset($this->product['descricao']) &&
                            isset($this->product['quantidade']) &&
                            isset($this->product['unidadeMedida']) &&
                            isset($this->product['dataValidade']) &&
                            isset($this->product['categoriaId']) &&
                            isset($this->product['fornecedorId']);
                    })
                     ->andReturn(true);
        });

        // Act
        $updateProductSerice = new UpdateProductService($this->updateProductRepository);
        $result = $updateProductSerice->update($this->request);

        // Assert
        $this->assertTrue($result);
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
