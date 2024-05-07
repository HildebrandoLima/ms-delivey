<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EditCategoryTest extends TestCase
{
    private function category(): array
    {
        return Categoria::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $category = $this->category();
        $data = [
            'id' => $category['id'],
            'nome' => Str::random(10),
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

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
     * @group category
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $data = [
            'id' => null,
            'nome' => null,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

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
     * @group category
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $category = $this->category();
        $data = [
            'id' => $category['id'],
            'nome' => $category['nome'],
            'ativo' => true,
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->putJson(route('category.edit'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_put_base_response_403(): void
    {
        // Arrange
        $category = $this->category();
        $data = [
            'id' => $category['id'],
            'nome' => $category['nome'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.edit'), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_put_base_response_404(): void
    {
        // Arrange
        $data = [
            'id' => 1000,
            'nome' => Str::random(10),
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.edit'), $data);

        // Assert
        $response->assertNotFound();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }
}
