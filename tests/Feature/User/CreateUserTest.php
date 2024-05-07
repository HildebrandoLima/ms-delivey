<?php

namespace Tests\Feature\User;

use App\Domains\Traits\GenerateData\GenerateCPF;
use App\Domains\Traits\GenerateData\GenerateEmail;
use App\Domains\Traits\GenerateData\GeneratePassword;
use App\Models\User;
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
            'perfil' => rand(0, 1),
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
            'perfil' => null,
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_post_base_response_404(): void
    {
        // Arrange
        $randKeys = array_rand($this->gender);
        $data = [
            'nome' => Str::random(10),
            'cpf' => $this->generateCPF(),
            'email' => $this->generateEmail(),
            'senha' => $this->generatePassword(),
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => 'A',
            'perfil' => rand(0, 1),
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
        $response->assertNotFound();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_post_base_response_409(): void
    {
        // Arrange
        $user = User::factory()->createOne()->toArray();
        $randKeys = array_rand($this->gender);
        $data = [
            'nome' => $user['nome'],
            'cpf' => $this->generateCPF(),
            'email' => $this->generateEmail(),
            'senha' => $this->generatePassword(),
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => $this->gender[$randKeys],
            'perfil' => rand(0, 1),
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
        $response->assertStatus(409);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 409);
    }
}
