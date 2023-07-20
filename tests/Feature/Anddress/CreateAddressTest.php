<?php

namespace Tests\Feature\Address;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateAddressTest extends TestCase
{
    private array $public_place = array('Rua', 'Avenida');

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_user(): void
    {
        // Arrange
        $rand_keys = array_rand($this->public_place);
        $data = [
            'logradouro' => $this->public_place[$rand_keys],
            'descricao' => Str::random(10),
            'bairro' => Str::random(10),
            'cidade' => Str::random(10),
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => rand(1, 27),
            'usuarioId' => User::query()->first()->id,
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('address.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_provider(): void
    {
        // Arrange
        $rand_keys = array_rand($this->public_place);
        $data = [
            'logradouro' => $this->public_place[$rand_keys],
            'descricao' => Str::random(10),
            'bairro' => Str::random(10),
            'cidade' => Str::random(10),
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => rand(1, 27),
            'fornecedorId' => Fornecedor::query()->first()->id,
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('address.save'), $data);

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
        $rand_keys = array_rand($this->public_place);
        $data = [
            'logradouro' => $this->public_place[$rand_keys],
            'descricao' => '',
            'bairro' => Str::random(10),
            'cidade' => Str::random(10),
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => rand(1, 27),
            'usuarioId' => '',
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('address.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
