<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Product\Interfaces\ICreateProductRepository;
use App\Domains\Services\Product\Concretes\CreateProductService;
use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\UploadedFile;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProductServiceTest extends TestCase
{
    private CreateProductRequest $request;
    private ICreateProductRepository $createProductRepository;
    private array $product = [];
    private array $images = [];
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataProduct();
    }

    public function test_success_create_product_service(): void
    {
        // Arrange
        $this->images = [
            UploadedFile::fake()->image('testing1.png'),
            UploadedFile::fake()->image('testing2.png')
        ];
        $this->request = new CreateProductRequest();
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
        $this->request['imagens'] = $this->images;

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
            'fornecedorId' => $this->data['fornecedorId'],
            'directory' => 'images/' . strtolower(str_replace(' ', '_', $this->data['nome'])),
            'imagens' => $this->images
        ];

        $this->createProductRepository = $this->mock(ICreateProductRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
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
                            isset($this->product['fornecedorId']) &&
                            isset($this->product['directory']) &&
                            isset($this->product['imagens']);
                    })
                     ->andReturn(true);
        });

        // Act
        $createProductService = new CreateProductService($this->createProductRepository);
        $result = $createProductService->create($this->request);

        // Assert
        foreach ($this->images as $image) {
            $this->assertFileExists($image->getPathname());
        }
        $this->assertTrue($result);
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
        $this->assertFileEquals($this->request['imagens'][0], $this->images[0]);
        $this->assertFileEquals($this->request['imagens'][1], $this->images[1]);
    }
}
