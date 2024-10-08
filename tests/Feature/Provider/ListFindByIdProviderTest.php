<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListFindByIdProviderTest extends TestCase
{
    private function provider(): array
    {
        return Fornecedor::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_find_base_response_200(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'active' => true
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.find', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_find_base_response_400(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'active' => null
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.find', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_find_base_response_401(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'active' => true
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->getJson(route('provider.list.find', $data));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_find_base_response_403(): void
    {
        // Arrange
        $provider = $this->provider();
        $data = [
            'id' => $provider['id'],
            'active' => true
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.find', $data));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
