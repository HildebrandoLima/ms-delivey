<?php

namespace Tests\Unit\Services\Product;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Data\Repositories\Abstracts\IProductRepository;
use App\Domains\Services\Product\Concretes\CreateProductService;
use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Support\Enums\PerfilEnum;
use Illuminate\Http\UploadedFile;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProductServiceTest extends TestCase
{
    private CreateProductRequest $request;
    private IEntityRepository $entityRepository;
    private IProductRepository  $productRepository;
    private array $images = [];

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_create_product_service(): void
    {
        // Arrange
        $this->images = [
            UploadedFile::fake()->image('testing1.png'),
            UploadedFile::fake()->image('testing2.png')
        ];
        $createdProduct = Produto::query()->first();
        $this->request = new CreateProductRequest();
        $this->request['nome'] = $createdProduct->nome;
        $this->request['precoCusto'] = $createdProduct->preco_custo;
        $this->request['precoVenda'] = $createdProduct->preco_venda;
        $this->request['codigoBarra'] = $createdProduct->codigo_barra;
        $this->request['descricao'] = $createdProduct->descricao;
        $this->request['quantidade'] = $createdProduct->quantidade;
        $this->request['unidadeMedida'] = $createdProduct->unidade_medida;
        $this->request['dataValidade'] = $createdProduct->data_validade;
        $this->request['categoriaId'] = $createdProduct->categoria_id;
        $this->request['fornecedorId'] = $createdProduct->fornecedor_id;
        $this->request['imagens'] = $this->images;
        $productId = $createdProduct->id;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

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
        $resultImage = $createProductService->createImage($this->request, $createdProduct->id);
        $mappedImage = $createProductService->mapImage($directory, $createdProduct->id);

        // Assert
        $this->assertTrue($resultProduct);
        $this->assertTrue($resultImage);
        $this->assertFileExists($this->images[0]);
        $this->assertInstanceOf(Produto::class, $mappedProduct);
        $this->assertInstanceOf(Imagem::class, $mappedImage);
        $this->assertEquals($this->request['nome'], $createdProduct->nome);
        $this->assertEquals($this->request['precoCusto'], $createdProduct->preco_custo);
        $this->assertEquals($this->request['precoVenda'], $createdProduct->preco_venda);
        $this->assertEquals($this->request['codigoBarra'], $createdProduct->codigo_barra);
        $this->assertEquals($this->request['descricao'], $createdProduct->descricao);
        $this->assertEquals($this->request['quantidade'], $createdProduct->quantidade);
        $this->assertEquals($this->request['unidadeMedida'], $createdProduct->unidade_medida);
        $this->assertEquals($this->request['dataValidade'], $createdProduct->data_validade);
        $this->assertEquals($this->request['categoriaId'], $createdProduct->categoria_id);
        $this->assertEquals($this->request['fornecedorId'], $createdProduct->fornecedor_id);
        $this->assertFileEquals($this->request['imagens'][0], $this->images[0]);
        $this->assertFileEquals($this->request['imagens'][1], $this->images[1]);
    }
}
