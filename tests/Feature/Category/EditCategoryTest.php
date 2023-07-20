<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditCategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $category = Categoria::query()->first()->toArray();
        $data = [
            'nome' => $category['nome'],
            'ativo' => $category['ativo']
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.edit', ['id' => base64_encode($category['id'])]), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $category = Categoria::query()->first()->toArray();
        $data = [
            'nome' => $category['nome'],
            'ativo' => ''
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.edit', ['id' => base64_encode($category['id'])]), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $category = Categoria::query()->first()->toArray();
        $data = [
            'nome' => $category['nome'],
            'ativo' => $category['ativo']
        ];

        // Act
        $response = $this->putJson(route('category.edit', ['id' => base64_encode($category['id'])]), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_403(): void
    {
        // Arrange
        $category = Categoria::query()->first()->toArray();
        $data = [
            'nome' => $category['nome'],
            'ativo' => $category['ativo']
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.edit', ['id' => base64_encode($category['id'])]), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
