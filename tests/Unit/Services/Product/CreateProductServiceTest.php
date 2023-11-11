<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Product\Concretes\CreateProductService;
use App\Support\Enums\PerfilEnum;
use Illuminate\Http\UploadedFile;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateProductServiceTest extends TestCase
{
    private CreateProductRequest $request;
    private IEntityRepository $productRepository;
    private array $images = [];

    public function test_success_create_product_service(): void
    {
        // Arrange
        $this->images = [
            UploadedFile::fake()->image('testing1.png'),
            UploadedFile::fake()->image('testing2.png')
        ];
        $this->request = new CreateProductRequest();
        $this->request['precoCusto'] = '1.500,00';
        $this->request['precoVenda'] = '2.000,00';
        $this->request['imagens'] = $this->images;

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->productRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Produto::class)->andReturn(true);
            $mock->shouldReceive('create')->with(Imagem::class)->andReturn(true);
        });

        // Act
        $createProductService = new CreateProductService($this->productRepository);

        $result = $createProductService->createProduct($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertFileExists($this->images[0]);
        $this->assertFileEquals($this->images[0], $this->request['imagens'][0]);
    }
}
