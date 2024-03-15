<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Enums\PerfilEnum;
use App\Support\Traits\GenerateCNPJ;
use App\Support\Traits\GenerateEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateProviderTest extends TestCase
{
    use GenerateCNPJ, GenerateEmail;
    /**
     * @test
     * @group provider
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $data = [
            'razaoSocial' => Str::random(10),
            'cnpj' => $this->generateCNPJ(),
            'email' => $this->generateEmail(),
            'dataFundacao' => date('Y-m-d H:i:s'),
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data = [
            'razaoSocial' => Str::random(10),
            'cnpj' => '',
            'email' => '',
            'dataFundacao' => date('Y-m-d H:i:s'),
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $provider = Fornecedor::factory()->createOne()->toArray();
        $data = [
            'razaoSocial' => Str::random(10),
            'cnpj' => $this->generateCNPJ(),
            'email' => $this->generateEmail(),
            'dataFundacao' => date('Y-m-d H:i:s'),
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->postJson(route('provider.save'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_post_base_response_403(): void
    {
        // Arrange
        $data = [
            'razaoSocial' => Str::random(10),
            'cnpj' => $this->generateCNPJ(),
            'email' => $this->generateEmail(),
            'dataFundacao' => date('Y-m-d H:i:s'),
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('provider.save'), $data);

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
