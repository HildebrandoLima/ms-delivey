<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use App\Support\Utils\Enums\PerfilEnum;
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
        $data = Categoria::query()->first()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

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
        $data = Categoria::query()->first()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.enable.disable', ['id' => base64_encode($data['id'])]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_401(): void
    {
        // Arrange
        $data = Categoria::query()->first()->toArray();

        // Act
        $response = $this->putJson(route('category.enable.disable', ['id' => base64_encode($data['id'])]));

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
        $data = Categoria::query()->first()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('category.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
