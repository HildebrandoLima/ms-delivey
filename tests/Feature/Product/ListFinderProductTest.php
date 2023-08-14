<?php

namespace Tests\Feature\Product;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListFinderProductTest extends TestCase
{
    private function product(): array
    {
        return Produto::factory()->createOne()->toArray();
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_base_response_200(): void
    {
        // Arrange
        $product = $this->product();
        $data = [
            'id' => $product['id'],
            'active' => true
        ];

        // Act
        $response = $this->getJson(route('product.list.find', $data));

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
        $product = $this->product();
        $data = [
            'id' => $product['id'],
            'active' => null
        ];

        // Act
        $response = $this->getJson(route('product.list.find', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
