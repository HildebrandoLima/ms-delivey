<?php

namespace Tests\Feature\User;

use App\Support\Generate\GenerateCPF;
use App\Support\Generate\GenerateEmail;
use App\Support\Generate\GeneratePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    private array $gender = array('Masculino', 'Feminino', 'Outro');

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $rand_keys = array_rand($this->gender);
        $data = [
            'nome' => Str::random(10),
            'cpf' => GenerateCPF::generateCPF(),
            'email' => GenerateEmail::generateEmail(),
            'senha' => GeneratePassword::generatePassword(),
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => $this->gender[$rand_keys],
            'perfil' => rand(0, 1), // 0 client 1 admin
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

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
        $rand_keys = array_rand($this->gender);
        $data = [
            'nome' => Str::random(10),
            'cpf' => GenerateCPF::generateCPF(),
            'email' => Str::random(10),
            'senha' => GeneratePassword::generatePassword(),
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => $this->gender[$rand_keys],
            'perfil' => rand(0, 1), // 0 client 1 admin
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
