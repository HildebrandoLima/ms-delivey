<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProviderAllTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        Fornecedor::factory(10)->create()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10, 'active' => 1]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(10, $this->countPaginateList($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_basea_response_400(): void
    {
        // Arrange
        Fornecedor::factory(10)->make()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_401(): void
    {
        // Arrange
        Fornecedor::factory(10)->make()->toArray();

        // Act
        $response = $this->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10, 'active' => 1]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_403(): void
    {
        // Arrange
        Fornecedor::factory(10)->make()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10, 'active' => 1]));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
