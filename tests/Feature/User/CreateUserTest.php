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
        $data = User::factory()->makeOne()->toArray();

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
        $response->assertOk();
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
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
