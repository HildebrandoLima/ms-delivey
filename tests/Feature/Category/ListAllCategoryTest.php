<?php

namespace Tests\Feature\Category;

use App\Domains\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAllCategoryTest extends TestCase
{
    private int $count = 5;

    private function category(): array
    {
        return Categoria::factory($this->count)->create()->toArray();
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_get_list_all_as_pagination_base_response_200(): void
    {
        // Arrange
        $data = $this->category();

        // Act
        $response = $this->getJson(route('category.list.all', ['page' => 1, 'perPage' => 10, 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(count($data), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_get_list_all_no_pagination_base_response_200(): void
    {
        // Arrange
        $data = $this->category();

        // Act
        $response = $this->getJson(route('category.list.all', ['active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(count($data), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_get_list_all_search_base_response_200(): void
    {
        // Arrange
        $data = Categoria::factory()->createOne()->toArray();

        // Act
        $response = $this->getJson(route('category.list.all', ['search' => $data['nome'], 'active' => true]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(count($data), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_get_list_all_base_response_400(): void
    {
        // Arrange
        $data = $this->category();

        // Act
        $response = $this->getJson(route('category.list.all'));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(count($data), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
