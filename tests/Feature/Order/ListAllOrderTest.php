<?php

namespace Tests\Feature\Order;

use App\Models\Pedido;
use App\Models\User;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllOrderTest extends TestCase
{
    private int $count = 3;

    /**
     * @test
     */
    public function it_endpoint_get_base_response_200_with_by_params_id(): void
    {
        // Arrange
        $user = User::query()->first()->id;
        Pedido::factory($this->count)->create(['usuario_id' => $user])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('order.list.all', ['page' => 1, 'perPage' => 10, 'search' => null, 'id' => $user, 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_with_by_params_search(): void
    {
        // Arrange
        $user = User::query()->first()->id;
        $order = Pedido::factory($this->count)->create(['usuario_id' => $user])->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('order.list.all', ['page' => 1, 'perPage' => 10, 'search' => $order[0]['numero_pedido'], 'id' => $user, 'active' => true]));

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
        Pedido::factory($this->count)->create()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

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
        $user = User::query()->first()->id;
        $order = Pedido::factory($this->count)->create()->toArray();

        // Act
        $response = $this->getJson(route('order.list.all', ['page' => 1, 'perPage' => 10, 'search' => $order[0]['numero_pedido'], 'id' => $user, 'active' => true]));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
