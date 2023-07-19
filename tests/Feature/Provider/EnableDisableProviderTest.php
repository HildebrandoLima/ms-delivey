<?php

namespace Tests\Feature\Provider;

use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Support\Utils\Enums\PerfilEnum;
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
        $data = Fornecedor::query()->first()->toArray();
        Endereco::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $data['id']])->toArray();
        Telefone::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $data['id']])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

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
        $data = Fornecedor::query()->first()->toArray();
        Endereco::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $data['id']])->toArray();
        Telefone::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $data['id']])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.enable.disable', ['id' => base64_encode($data['id'])]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
    */
    public function it_endpoint_put_enable_disable_base_response_401(): void
    {
        // Arrange
        $data = Fornecedor::query()->first()->toArray();
        Endereco::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $data['id']])->toArray();
        Telefone::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $data['id']])->toArray();

        // Act
        $response = $this->putJson(route('provider.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

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
        $data = Fornecedor::query()->first()->toArray();
        Endereco::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $data['id']])->toArray();
        Telefone::factory()->createOne(['usuario_id' => null, 'fornecedor_id' => $data['id']])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('provider.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
