<?php

namespace Tests\Feature\Order;

use App\Models\Pedido;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListFindByIdOrderTest extends TestCase
{
    private function order(): array
    {
        return Pedido::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_get_base_response_200(): void
    {
        // Arrange
        $order = $this->order();
        $data = [
            'id' => $order['id'],
            'active' => true
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('order.list.find', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_get_base_response_400(): void
    {
        // Arrange
        $order = $this->order();
        $data = [
            'id' => $order['id'],
            'active' => null
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('order.list.find', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_get_base_response_401(): void
    {
        // Arrange
        $order = $this->order();
        $data = [
            'id' => $order['id'],
            'active' => true
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->getJson(route('order.list.find', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
