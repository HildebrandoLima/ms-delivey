<?php

namespace Tests\Feature\Product;

use App\Models\Item;
use App\Models\Pagamento;
use App\Models\Pedido;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnableDisableOrderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_enable_disable_base_response_200(): void
    {
        // Arrange
        $data = Pedido::query()->first()->toArray();
        Pagamento::factory()->createOne(['pedido_id' => $data['id']])->toArray();
        Item::factory()->createOne(['pedido_id' => $data['id']])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('order.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

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
        $data = Pedido::query()->first()->toArray();
        Pagamento::factory()->createOne(['pedido_id' => $data['id']])->toArray();
        Item::factory()->createOne(['pedido_id' => $data['id']])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('order.enable.disable', ['id' => base64_encode($data['id'])]));

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
        $data = Pedido::query()->first()->toArray();
        Pagamento::factory()->createOne(['pedido_id' => $data['id']])->toArray();
        Item::factory()->createOne(['pedido_id' => $data['id']])->toArray();

        // Act
        $response = $this->putJson(route('order.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
