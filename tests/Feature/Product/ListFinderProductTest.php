<?php

namespace Tests\Feature\Product;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListFinderProductTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_find_base_response_200(): void
    {
        // Arrange
        $data = Produto::factory()->createOne()->toArray();

        // Act
        $response = $this->getJson(route('product.list.find', ['id' => base64_encode($data['id']), 'active' => 1]));

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
        $data = Produto::factory()->createOne()->toArray();

        // Act
        $response = $this->getJson(route('product.list.find', ['id' => base64_encode($data['id'])]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
