<?php

namespace Tests\Feature\User;

use App\Support\Traits\GenerateCPF;
use App\Support\Traits\GenerateEmail;
use App\Support\Traits\GeneratePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use GenerateCPF, GenerateEmail, GeneratePassword;
    private array $gender = array('Masculino', 'Feminino', 'Outro');

    /**
     * @test
     * @group user
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $randKeys = array_rand($this->gender);
        $data = [
            'nome' => Str::random(10),
            'cpf' => $this->generateCPF(),
            'email' => $this->generateEmail(),
            'senha' => $this->generatePassword(),
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => $this->gender[$randKeys],
            'eAdmin' => rand(0, 1),
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
     * @group user
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $randKeys = array_rand($this->gender);
        $data = [
            'nome' => Str::random(10),
            'cpf' => null,
            'email' => Str::random(10),
            'senha' => $this->generatePassword(),
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => $this->gender[$randKeys],
            'eAdmin' => null,
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
