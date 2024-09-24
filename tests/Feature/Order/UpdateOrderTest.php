<?php

namespace Tests\Feature\Order;

use App\Models\Pedido;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateOrderTest extends TestCase
{
    private function order(): array
    {
        return Pedido::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_put_base_response_200(): void
    {
        // Arrange
        $order = $this->order();
        $data = [
            'id' => $order['id'],
            'active' => false,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('order.edit'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $data = [
            'id' => null,
            'active' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('order.edit'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $order = $this->order();
        $data = [
            'id' => $order['id'],
            'active' => true,
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->putJson(route('order.edit'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group order
     */
    public function it_endpoint_put_base_response_404(): void
    {
        // Arrange
        $data = [
            'id' => 1000,
            'active' => false,
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('order.edit'), $data);

        // Assert
        $response->assertNotFound();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }
}
