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
        $address = Endereco::factory()->makeOne()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => '12345-678',
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
        $address = Endereco::factory()->makeOne()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => '12345-789',
            'ufId' => $address['uf_id'],
            'fornecedorId' => $address['fornecedor_id'],
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
        $address = Endereco::factory()->makeOne()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => '',
            'cep' => '',
            'ufId' => $address['uf_id'],
            'fornecedorId' => $address['fornecedor_id'],
            'ativo' => $address['ativo'],
        ];

        // Act
        $response = $this->postJson(route('address.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
