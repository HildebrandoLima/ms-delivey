<?php

namespace Tests\Feature\Provider;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnableDisableProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_200(): void
    {
        // Arrange
        $provider = Fornecedor::factory()->createOne()->toArray();
        Endereco::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $provider['id']])->toArray();
        Telefone::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $provider['id']])->toArray();
        $data = [
            'id' => $provider['id'],
            'active' => false
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.enable.disable', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
    */
    public function it_endpoint_put_enable_disable_base_response_400(): void
    {
        // Arrange
        $provider = Fornecedor::query()->first()->toArray();
        Endereco::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $provider['id']])->toArray();
        Telefone::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $provider['id']])->toArray();
        $data = [
            'id' => $provider['id'],
            'active' => null
        ];
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.enable.disable', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
    */
    public function it_endpoint_put_enable_disable_base_response_401(): void
    {
        // Arrange
        $provider = Fornecedor::query()->first()->toArray();
        Endereco::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $provider['id']])->toArray();
        Telefone::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $provider['id']])->toArray();
        $data = [
            'id' => $provider['id'],
            'active' => true
        ];

        // Act
        $response = $this->putJson(route('provider.enable.disable', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_403(): void
    {
        // Arrange
        $provider = Fornecedor::query()->first()->toArray();
        Endereco::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $provider['id']])->toArray();
        Telefone::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $provider['id']])->toArray();
        $data = [
            'id' => $provider['id'],
            'active' => true
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.enable.disable', $data));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
