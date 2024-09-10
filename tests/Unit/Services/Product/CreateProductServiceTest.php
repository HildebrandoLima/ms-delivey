<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Data\Repositories\Abstracts\IProductRepository;
use App\Domains\Services\Product\Concretes\CreateProductService;
use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use Illuminate\Http\UploadedFile;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProductServiceTest extends TestCase
{
    private CreateProductRequest $request;
    private IEntityRepository $entityRepository;
    private IProductRepository  $productRepository;
    private array $images = [];
    private array $data;

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
        $productId = $this->data['id'];

        $this->entityRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Produto::class)->andReturn(true);
            $mock->shouldReceive('create')->with(Imagem::class)->andReturn(true);
        });

        $this->productRepository = $this->mock(IProductRepository::class,
        function (MockInterface $mock) use ($productId) {
            $mock->shouldReceive('delete')->with($productId)->andReturn(true);
        });

        // Act
        $createProductService = new CreateProductService($this->entityRepository, $this->productRepository);
        $resultProduct = $createProductService->createProduct($this->request);
        $mappedProduct = $createProductService->mapProduct($this->request);
        $directory = $createProductService->directory($this->request['nome']);
        $resultImage = $createProductService->createImage($this->request, $productId);
        $mappedImage = $createProductService->mapImage($directory, $productId);

        // Assert
        $this->assertTrue($resultProduct);
        $this->assertTrue($resultImage);
        $this->assertFileExists($this->images[0]);
        $this->assertInstanceOf(Produto::class, $mappedProduct);
        $this->assertInstanceOf(Imagem::class, $mappedImage);
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
