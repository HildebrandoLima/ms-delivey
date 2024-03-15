<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllProviderTest extends TestCase
{
    private int $count = 10;

    private function provider(): array
    {
        return Fornecedor::factory($this->count)->create()->toArray();
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        $this->provider();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10, 'search' => null, 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->count, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_all_search_base_response_200(): void
    {
        // Arrange
        $data = $this->provider();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10, 'search' => $data[0]['razao_social'], 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_all_basea_response_400(): void
    {
        // Arrange
        $this->provider();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10, 'search' => null]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_all_base_response_401(): void
    {
        // Arrange
        $this->provider();

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10, 'search' => null, 'active' => true]));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group provider
     */
    public function it_endpoint_get_list_all_base_response_403(): void
    {
        // Arrange
        $this->provider();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10, 'search' => null, 'active' => true]));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
