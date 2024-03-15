<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllUserTest extends TestCase
{
    private int $count = 10;

    private function user(): array
    {
        return User::factory($this->count)->create()->toArray();
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        $this->user();

        // Act
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'seacrh' => null, 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->count, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_all_search_base_response_200(): void
    {
        // Arrange
        $data = $this->user();

        // Act
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'seacrh' => $data[0]['nome'], 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->count, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_all_base_response_400(): void
    {
        // Arrange
        $this->user();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'seacrh' => null]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_all_base_response_401(): void
    {
        // Arrange
        $this->user();

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'seacrh' => null, 'active' => true]));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_all_base_response_403(): void
    {
        // Arrange
        $this->user();

        // Act
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'seacrh' => null, 'active' => true]));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
