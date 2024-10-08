<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateProviderTest extends TestCase
{
    private function provider(): array
    {
        return Fornecedor::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'razaoSocial' => Str::random(10),
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

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
     * @group provider
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
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

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
     * @group provider
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'razaoSocial' => Str::random(10),
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
            'ativo' => true,
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->putJson(route('provider.edit'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_put_base_response_403(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'razaoSocial' => Str::random(10),
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.edit'), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_put_base_response_404(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => 1000,
            'razaoSocial' => Str::random(10),
            'cnpj' => $provider['cnpj'],
            'email' => $provider['email'],
            'dataFundacao' => $provider['data_fundacao'],
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.edit'), $data);

        // Assert
        $response->assertNotFound();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }
}
