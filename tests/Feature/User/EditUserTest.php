<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_200(): void
    {
        // Arrange
        $user = User::query()->first()->toArray();
        $data = [
            'nome' => $user['name'],
            'email' => $user['email'],
            'genero' => $user['genero'],
            'perfil' => false,
            'ativo' => $user['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.edit', ['id' => base64_encode($user['id'])]), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_400(): void
    {
        // Arrange
        $user = User::query()->first()->toArray();
        $data = [
            'nome' => $user['name'],
            'email' => '',
            'genero' => $user['genero'],
            'perfil' => false,
            'ativo' => $user['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.edit', ['id' => base64_encode($user['id'])]), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_401(): void
    {
        // Arrange
        $user = User::query()->first()->toArray();
        $data = [
            'nome' => $user['name'],
            'email' => $user['email'],
            'genero' => $user['genero'],
            'perfil' => false,
            'ativo' => $user['ativo'],
        ];

        // Act
        $response = $this->putJson(route('user.edit', ['id' => base64_encode($user['id'])]), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
