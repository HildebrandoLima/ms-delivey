<?php

namespace Tests\Feature\Product;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProductAllTest extends TestCase
{
    private int $count = 10;

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        Produto::factory($this->count)->create()->toArray();

        // Act
        $response = $this->getJson(route('product.list.all', ['page' => 1, 'perPage' => 10, 'active' => 1]));

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
        Produto::factory($this->count)->create()->toArray();

        // Act
        $response = $this->getJson(route('product.list.all', ['page' => 1, 'perPage' => 10]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
