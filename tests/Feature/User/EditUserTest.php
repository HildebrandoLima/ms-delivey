<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    private function user(): array
    {
        return User::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $user = $this->user();
        $data = [
            'id' => $user['id'],
            'nome' => Str::random(10),
            'email' => $user['email'],
            'genero' => $user['genero'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.edit'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $user = $this->user();
        $data = [
            'id' => $user['id'],
            'nome' => null,
            'email' => null,
            'genero' => $user['genero'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.edit'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $user = $this->user();
        $data = [
            'id' => $user['id'],
            'nome' => $user['nome'],
            'email' => $user['email'],
            'genero' => 'Outro',
            'ativo' => true,
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->putJson(route('user.edit'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_put_base_response_404(): void
    {
        // Arrange
        $user = $this->user();
        $data = [
            'id' => 1000,
            'nome' => Str::random(10),
            'email' => $user['email'],
            'genero' => 'A',
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.edit'), $data);

        // Assert
        $response->assertNotFound();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }
}
