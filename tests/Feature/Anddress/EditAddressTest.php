<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_base_response_200_edit_user(): void
    {
        // Arrange
        $address = Endereco::query()->first()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => $address['uf_id'],
            'usuarioId' => User::query()->first()->id,
            'ativo' => $address['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('address.edit', ['id' => base64_encode($address['id'])]), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_200_edit_provider(): void
    {
        // Arrange
        $address = Endereco::query()->first()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => $address['uf_id'],
            'fornecedorId' => Fornecedor::query()->first()->id,
            'ativo' => $address['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('address.edit', ['id' => base64_encode($address['id'])]), $data);

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
        $address = Endereco::query()->first()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['descricao'],
            'cidade' => $address['cidade'],
            'cep' => $address['cep'],
            'ufId' => $address['uf_id'],
            'usuarioId' => '',
            'ativo' => $address['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('address.edit', ['id' => base64_encode($address['id'])]), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $address = Endereco::query()->first()->toArray();
        $data = [
            'logradouro' => $address['logradouro'],
            'descricao' => $address['descricao'],
            'bairro' => $address['bairro'],
            'cidade' => $address['cidade'],
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'ufId' => $address['uf_id'],
            'fornecedorId' => Fornecedor::query()->first()->id,
            'ativo' => $address['ativo'],
        ];

        // Act
        $response = $this->putJson(route('address.edit', ['id' => base64_encode($address['id'])]), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
