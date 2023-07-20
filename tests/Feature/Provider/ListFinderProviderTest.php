<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListFinderProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_find_base_response_200(): void
    {
        // Arrange
        $data = Fornecedor::factory()->createOne()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.find', ['id' => base64_encode($data['id']), 'active' => 1]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_base_response_400(): void
    {
        // Arrange
        $data = Fornecedor::factory()->createOne()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.find', ['id' => base64_encode($data['id'])]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_base_response_401(): void
    {
        // Arrange
        $data = Fornecedor::factory()->createOne()->toArray();

        // Act
        $response = $this->getJson(route('provider.list.find', ['id' => base64_encode($data['id']), 'active' => 1]));

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_base_response_403(): void
    {
        // Arrange
        $data = Fornecedor::factory()->createOne()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('provider.list.find', ['id' => base64_encode($data['id']), 'active' => 1]));

        // Assert
        $response->assertForbidden();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 403);
    }
}
