<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $provider = Fornecedor::factory()->makeOne()->toArray();
        $data = [
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => '24.975.136/0001-85',
            'email' => $provider['email'],
            'dataFundacao' => date('Y-m-d H:i:s'),
            'ativo' => $provider['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            //
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $provider = Fornecedor::factory()->makeOne()->toArray();
        $data = [
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => '24.975.136/0001-85',
            'email' => $provider['email'],
            'dataFundacao' => date('Y-m-d H:i:s'),
            'ativo' => $provider['ativo'],
        ];

        // Act
        $response = $this->postJson(route('provider.save'), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_403(): void
    {
        // Arrange
        $provider = Fornecedor::factory()->makeOne()->toArray();
        $data = [
            'razaoSocial' => $provider['razao_social'],
            'cnpj' => '24.975.136/0001-85',
            'email' => $provider['email'],
            'dataFundacao' => date('Y-m-d H:i:s'),
            'ativo' => $provider['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
