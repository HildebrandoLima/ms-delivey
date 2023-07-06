<?php

namespace Tests\Feature\Address;

use App\Models\Fornecedor;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_user(): void
    {
        // Arrange
        $logradouro = array('Rua', 'Avenida');
        $rand_keys = array_rand($logradouro);
        $data = [
            'logradouro' => $logradouro[$rand_keys],
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
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_provider(): void
    {
        // Arrange
        $logradouro = array('Rua', 'Avenida');
        $rand_keys = array_rand($logradouro);
        $data = [
            'logradouro' => $logradouro[$rand_keys],
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
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $logradouro = array('Rua', 'Avenida');
        $rand_keys = array_rand($logradouro);
        $data = [
            'logradouro' => $logradouro[$rand_keys],
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
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
