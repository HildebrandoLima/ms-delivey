<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllCategoryTest extends TestCase
{
    private int $count = 5;

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        $data = Categoria::factory($this->count)->create()->toArray();

        // Act
        $response = $this->getJson(route('category.list.all', ['active' => 1]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(count($data), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_400(): void
    {
        // Arrange
        $data = Categoria::factory($this->count)->make()->toArray();

        // Act
        $response = $this->getJson(route('category.list.all'));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(count($data), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
