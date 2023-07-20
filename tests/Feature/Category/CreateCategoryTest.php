<?php

namespace Tests\Feature\Category;

use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $data = [
            'nome' => Str::random(10),
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('category.save', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'nome' => Str::random(10),
            'ativo' => '',
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('category.save', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $data = [
            'nome' => Str::random(10),
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('category.save', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_403(): void
    {
        // Arrange
        $data = [
            'nome' => Str::random(10),
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('category.save', $data));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
