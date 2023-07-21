<?php

namespace Tests\Feature\Product;

use App\Models\Imagem;
use App\Models\Produto;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnableDisableProductTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_200(): void
    {
        // Arrange
        $data = Produto::factory()->createOne()->toArray();
        Imagem::factory(1)->create(['produto_id' => $data['id']])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('product.enable.disable', ['id' => base64_encode($data['id']), 'active' => false]));

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
        $data = Produto::query()->first()->toArray();
        Imagem::factory(1)->create(['produto_id' => $data['id']])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('product.enable.disable', ['id' => base64_encode($data['id'])]));

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
        $data = Produto::query()->first()->toArray();
        Imagem::factory(1)->create(['produto_id' => $data['id']])->toArray();

        // Act
        $response = $this->putJson(route('product.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

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
        $data = Produto::query()->first()->toArray();
        Imagem::factory(1)->create(['produto_id' => $data['id']])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('product.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
