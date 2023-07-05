<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $user = User::factory()->makeOne()->toArray();
        $data = [
            'nome' => $user['name'],
            'cpf' => $user['cpf'],
            'email' => $user['email'],
            'senha' => 'Password@3',
            'dataNascimento' => date_format($user['data_nascimento'], 'Y-m-d H:i:s'),
            'genero' => $user['genero'],
            'perfil' => false,
            'ativo' => $user['ativo'],
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
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
            'perfil' => false,
            'nome' => 'Fulano',
            'cpf' => '',
            'email' => '',
            'senha' => '@Teste.1.7',
            'dataNascimento' => now(),
            'genero' => 'Outro',
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
