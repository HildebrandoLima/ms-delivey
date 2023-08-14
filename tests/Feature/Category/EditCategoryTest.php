<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditCategoryTest extends TestCase
{
    private function category(): array
    {
        return Categoria::query()->first()->toArray();
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $category = $this->category();
        $data = [
            'id' => $category['id'],
            'nome' => $category['nome'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.edit'), $data);

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
        $data = [
            'id' => null,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.edit'), $data);

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
        $category = $this->category();
        $data = [
            'id' => $category['id'],
            'nome' => $category['nome'],
        ];

        // Act
        $response = $this->putJson(route('category.edit'), $data);

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
        $category = $this->category();
        $data = [
            'id' => $category['id'],
            'nome' => $category['nome'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.edit'), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
