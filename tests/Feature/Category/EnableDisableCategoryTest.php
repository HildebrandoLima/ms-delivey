<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnableDisableCategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_200(): void
    {
        // Arrange
        $category = Categoria::factory()->createOne()->toArray();
        $data = [
            'id' => $category['id'],
            'active' => false
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.enable.disable', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_400(): void
    {
        // Arrange
        $category = Categoria::query()->first()->toArray();
        $data = [
            'id' => $category['id'],
            'active' => null
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.enable.disable'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_401(): void
    {
        // Arrange
        $category = Categoria::query()->first()->toArray();
        $data = [
            'id' => $category['id'],
            'active' => false
        ];

        // Act
        $response = $this->putJson(route('category.enable.disable'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_403(): void
    {
        // Arrange
        $category = Categoria::query()->first()->toArray();
        $data = [
            'id' => $category['id'],
            'active' => false
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.enable.disable'), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
