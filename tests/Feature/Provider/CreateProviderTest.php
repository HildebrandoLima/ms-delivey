<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Generate\GenerateCNPJ;
use App\Support\Generate\GenerateEmail;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $data = [
            'razaoSocial' => Str::random(10),
            'cnpj' => GenerateCNPJ::generateCNPJ(),
            'email' => GenerateEmail::generateEmail(),
            'dataFundacao' => date('Y-m-d H:i:s'),
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

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
        $data = [
            'razaoSocial' => Str::random(10),
            'cnpj' => '',
            'email' => '',
            'dataFundacao' => date('Y-m-d H:i:s'),
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $provider = Fornecedor::factory()->createOne()->toArray();
        $data = [
            'razaoSocial' => Str::random(10),
            'cnpj' => GenerateCNPJ::generateCNPJ(),
            'email' => GenerateEmail::generateEmail(),
            'dataFundacao' => date('Y-m-d H:i:s'),
            'ativo' => true,
        ];

        // Act
        $response = $this->postJson(route('provider.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_403(): void
    {
        // Arrange
        $data = [
            'razaoSocial' => Str::random(10),
            'cnpj' => GenerateCNPJ::generateCNPJ(),
            'email' => GenerateEmail::generateEmail(),
            'dataFundacao' => date('Y-m-d H:i:s'),
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
