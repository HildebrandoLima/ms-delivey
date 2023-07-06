<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_user(): void
    {
        // Arrange
        $address = Endereco::factory()->createOne()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => $address['uf_id'],
            'usuarioId' => $address['usuario_id'],
            'ativo' => $address['ativo'],
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
        $address = Endereco::factory()->createOne()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => $address['uf_id'],
            'usuarioId' => $address['usuario_id'],
            'ativo' => $address['ativo'],
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
        $address = Endereco::factory()->createOne()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => '',
            'bairro' => '',
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => $address['uf_id'],
            'usuarioId' => $address['usuario_id'],
            'ativo' => $address['ativo'],
        ];

        // Act
        $response = $this->postJson(route('address.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
