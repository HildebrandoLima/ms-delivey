<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListFindByIdUserTest extends TestCase
{
    private function user(): array
    {
        return User::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_find_base_response_200(): void
    {
        // Arrange
        $user = $this->user();
        $data = [
            'id' => $user['id'],
            'active' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.find', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_find_base_response_400(): void
    {
        // Arrange
        $user = $this->user();
        $data = [
            'id' => $user['id'],
            'active' => null,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.find', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_list_find_base_response_401(): void
    {
        // Arrange
        $user = $this->user();
        $data = [
            'id' => $user['id'],
            'active' => true,
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->getJson(route('user.list.find', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
