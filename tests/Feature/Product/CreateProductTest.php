<?php

namespace Tests\Feature\Product;

use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    private array $unitMeasure = array('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX');
    private array $images = [];

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $rand_keys = array_rand($this->unitMeasure);
        $this->images = [
            UploadedFile::fake()->image('testing1.png'),
            UploadedFile::fake()->image('testing2.png')
        ];
        $data = [
            'nome' => Str::random(10),
            'precoCusto' => 15.30,
            'precoVenda' => 20.0,
            'codigoBarra' => Str::random(13),
            'descricao' => Str::random(30),
            'quantidade' => rand(10, 50),
            'unidadeMedida' => $this->unitMeasure[$rand_keys],
            'dataValidade' => date('Y-m-d H:i:s'),
            'categoriaId' => Categoria::query()->first()->id,
            'fornecedorId' => Fornecedor::query()->first()->id,
            'imagens' => $this->images,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('product.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertFileExists($this->images[0]);
        $this->assertFileEquals($this->images[0], $data['imagens'][0]);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $rand_keys = array_rand($this->unitMeasure);
        $this->images = [
            UploadedFile::fake()->image('testing1.png'),
            UploadedFile::fake()->image('testing2.png')
        ];
        $data = [
            'nome' => Str::random(10),
            'precoCusto' => null,
            'precoVenda' => null,
            'codigoBarra' => Str::random(13),
            'descricao' => Str::random(30),
            'quantidade' => rand(10, 50),
            'unidadeMedida' => $this->unitMeasure[$rand_keys],
            'dataValidade' => date('Y-m-d H:i:s'),
            'categoriaId' => Categoria::query()->first()->id,
            'fornecedorId' => Fornecedor::query()->first()->id,
            'imagens' => $this->images,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('product.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertFileExists($this->images[0]);
        $this->assertFileEquals($this->images[0], $data['imagens'][0]);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $rand_keys = array_rand($this->unitMeasure);
        $this->images = [
            UploadedFile::fake()->image('testing1.png'),
            UploadedFile::fake()->image('testing2.png')
        ];
        $data = [
            'nome' => Str::random(10),
            'precoCusto' => 15.30,
            'precoVenda' => 20.0,
            'codigoBarra' => Str::random(13),
            'descricao' => Str::random(30),
            'quantidade' => rand(10, 50),
            'unidadeMedida' => $this->unitMeasure[$rand_keys],
            'dataValidade' => date('Y-m-d H:i:s'),
            'categoriaId' => Categoria::query()->first()->id,
            'fornecedorId' => Fornecedor::query()->first()->id,
            'imagens' => $this->images,
        ];

        // Act
        $response = $this->postJson(route('product.save'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertFileExists($this->images[0]);
        $this->assertFileEquals($this->images[0], $data['imagens'][0]);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_403(): void
    {
        // Arrange
        $rand_keys = array_rand($this->unitMeasure);
        $this->images = [
            UploadedFile::fake()->image('testing1.png'),
            UploadedFile::fake()->image('testing2.png')
        ];
        $data = [
            'nome' => Str::random(10),
            'precoCusto' => 15.30,
            'precoVenda' => 20.0,
            'codigoBarra' => Str::random(13),
            'descricao' => Str::random(30),
            'quantidade' => rand(10, 50),
            'unidadeMedida' => $this->unitMeasure[$rand_keys],
            'dataValidade' => date('Y-m-d H:i:s'),
            'categoriaId' => Categoria::query()->first()->id,
            'fornecedorId' => Fornecedor::query()->first()->id,
            'imagens' => $this->images,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('product.save'), $data);

        // Assert
        $response->assertForbidden();
        $this->assertFileExists($this->images[0]);
        $this->assertFileEquals($this->images[0], $data['imagens'][0]);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
