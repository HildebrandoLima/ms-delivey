<?php

namespace Tests\Unit\Services\Provider;

use App\Http\Requests\Product\EditProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Product\Concretes\EditProductService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditProductServiceTest extends TestCase
{
    private EditProductRequest $request;
    private IEntityRepository $productRepository;

    public function test_success_edit_product_service(): void
    {
        // Arrange
        $this->request = new EditProductRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['precoCusto'] = '1.500,00';
        $this->request['precoVenda'] = '2.000,00';

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

        $result = $editProductSerice->editProduct($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
