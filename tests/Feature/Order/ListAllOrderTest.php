<?php

namespace Tests\Feature\Order;

use App\Models\Pedido;
use App\Models\User;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllOrderTest extends TestCase
{
    private function order(): array
    {
        $user = User::query()->first()->id;
        $order = Pedido::query()->first()->numero_pedido;
        return ['user' => $user, 'order' => $order];
    }

    /**
     * @test
     */
    public function it_endpoint_get_with_by_params_id_base_response_200(): void
    {
        // Arrange
        $data = $this->order();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('order.list.all', ['page' => 1, 'perPage' => 10, 'search' => null, 'id' => $data['user'], 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_with_by_params_search_base_response_200(): void
    {
        // Arrange
        $data = $this->order();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('order.list.all', ['page' => 1, 'perPage' => 10, 'search' => $data['order'], 'id' => $data['user'], 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_base_response_400(): void
    {
        // Arrange
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('order.list.all', ['page' => 1, 'perPage' => 10]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $data = $this->order();

        // Act
        $response = $this->getJson(route('order.list.all', ['page' => 1, 'perPage' => 10, 'search' => null, 'id' => $data['user'], 'active' => true]));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
