<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Product\Concretes\CreateProductService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProductServiceTest extends TestCase
{
    private CreateProductRequest $request;
    private ProductRepositoryInterface $productRepository;
    private ImageRepositoryInterface $imageRepository;
    private array $unitMeasure = array('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX');
    private array $images = [];

    public function test_success_create_product_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->unitMeasure);
        $this->images = [
            UploadedFile::fake()->image('testing1.png'),
            UploadedFile::fake()->image('testing2.png')
        ];
        $this->request = new CreateProductRequest();
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
        $this->request['imagens'] = $this->images;
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->productRepository = $this->mock(ProductRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Produto::class)->andReturn(true);
        });

        $this->imageRepository = $this->mock(ImageRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Imagem::class)->andReturn(true);
        });

        // Act
        $createProductService = new CreateProductService
        (
            $this->productRepository,
            $this->imageRepository
        );

        $result = $createProductService->createProduct($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertFileExists($this->images[0]);
        $this->assertFileEquals($this->images[0], $this->request['imagens'][0]);
    }
}
