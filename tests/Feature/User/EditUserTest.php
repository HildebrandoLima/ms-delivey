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
        $user = User::factory()->createOne()->toArray();
        $data = [
            'nome' => $user['name'],
            'cpf' => '318.794.670-46',
            'email' => $user['email'],
            'senha' => 'Password@3',
            'dataNascimento' => '2023-07-01 14:23:23',
            'genero' => $user['genero'],
            'perfil' => false,
            'ativo' => 0,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.edit', ['id' => base64_encode($user['id'])]), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_400(): void
    {
        // Arrange
        $user = User::factory()->createOne()->toArray();
        $data = [
            'nome' => $user['name'],
            'cpf' => '318.794.670-46',
            'email' => $user['email'],
            'dataNascimento' => '2023-07-01 14:23:23',
            'genero' => $user['genero'],
            'perfil' => false,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.edit', ['id' => base64_encode($user['id'])]), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_401(): void
    {
        // Arrange
        $user = User::factory()->createOne()->toArray();
        $data = [
            'nome' => $user['name'],
            'cpf' => '318.794.670-46',
            'email' => $user['email'],
            'dataNascimento' => '2023-07-01 14:23:23',
            'genero' => $user['genero'],
            'perfil' => false,
        ];

        // Act
        $response = $this->putJson(route('user.edit', ['id' => base64_encode($user['id'])]), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
