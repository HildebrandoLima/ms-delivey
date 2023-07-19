<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $provider = Fornecedor::query()->first()->toArray();
        $data = [
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
            'ativo' => 0,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.edit', ['id' => base64_encode($provider['id'])]), $data);

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
        $provider = Fornecedor::query()->first()->toArray();
        $data = [
            'razaoSocial' => '',
            'cnpj' => $provider['cnpj'],
            'email' => '',
            'dataFundacao' => $provider['data_fundacao'],
            'ativo' => 1,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.edit', ['id' => base64_encode($provider['id'])]), $data);

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
        $provider = Fornecedor::query()->first()->toArray();
        $data = [
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
            'ativo' => 0,
        ];

        // Act
        $response = $this->putJson(route('provider.edit', ['id' => base64_encode($provider['id'])]), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_403(): void
    {
        // Arrange
        $provider = Fornecedor::query()->first()->toArray();
        $data = [
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
            'ativo' => 0,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.edit', ['id' => base64_encode($provider['id'])]), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
