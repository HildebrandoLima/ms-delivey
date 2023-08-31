<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\User;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditAddressTest extends TestCase
{
    private function address(): array
    {
        return Endereco::factory()->createOne()->toArray();
    }

    /**
     * @test
     */
    public function it_endpoint_put_edit_user_base_response_200(): void
    {
        // Arrange
        $address = $this->address();
        $data = [
            'id' => $address['id'],
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'uf' => $address['uf'],
            'usuarioId' => User::factory()->createOne()->id,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('address.edit'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_edit_provider_base_response_200(): void
    {
        // Arrange
        $address = $this->address();
        $data = [
            'id' => $address['id'],
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'uf' => $address['uf'],
            'fornecedorId' => Fornecedor::factory()->createOne()->id,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('address.edit'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $address = $this->address();
        $data = [
            'id' => $address['id'],
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['descricao'],
            'cidade' => $address['cidade'],
            'cep' => $address['cep'],
            'uf' => null,
            'usuarioId' => null,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('address.edit'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $address = $this->address();
        $data = [
            'id' => $address['id'],
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'uf' => $address['uf'],
            'fornecedorId' => Fornecedor::factory()->createOne()->id,
            'ativo' => true,
        ];

        // Act
        $response = $this->putJson(route('address.edit'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
