<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateFirstUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_create_first_user_admin_test(): void
    {
        // Arrange
        $data = [
            'nome' => 'Hill',
            'cpf' => '305.023.110-61',
            'email' => 'hildebrandolima16@gmail.com',
            'senha' => 'HiLd3br@ndo',
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => 'Outro',
            'eAdmin' => true,
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
    public function it_create_first_user_client_test(): void
    {
        // Arrange
        $data = [
            'nome' => 'Cliente',
            'cpf' => '470.672.250-00',
            'email' => 'cliente@gmail.com',
            'senha' => '@PClient5',
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => 'Outro',
            'eAdmin' => false,
        ];

        // Act
        $response = $this->postJson(route('user.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
