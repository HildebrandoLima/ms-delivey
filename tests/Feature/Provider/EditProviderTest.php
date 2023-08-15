<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProviderTest extends TestCase
{
    private function provider(): array
    {
        return Fornecedor::query()->first()->toArray();
    }

    /**
     * @test
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.edit'), $data);

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
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'razaoSocial' => null,
            'cnpj' => $provider['cnpj'],
            'email' => null,
            'dataFundacao' => $provider['data_fundacao'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.edit'), $data);

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
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
        ];

        // Act
        $response = $this->putJson(route('provider.edit'), $data);

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
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.edit'), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
