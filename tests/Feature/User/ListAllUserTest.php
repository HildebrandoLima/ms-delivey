<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllUserTest extends TestCase
{
    private int $count = 10;

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        User::factory($this->count)->create()->toArray();

        // Act
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'active' => 1]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->count, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_400(): void
    {
        // Arrange
        User::factory($this->count)->make()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_401(): void
    {
        // Arrange
        User::factory($this->count)->make()->toArray();

        // Act
        $response = $this->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'active' => 1]));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
