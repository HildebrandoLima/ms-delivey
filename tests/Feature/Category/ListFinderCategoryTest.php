<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListFinderCategoryTest extends TestCase
{
    private function category(): array
    {
        return Categoria::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_get_list_find_base_response_200(): void
    {
        // Arrange
        $category = $this->category();
        $data = [
            'id' => $category['id'],
            'active' => true
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('category.list.find', $data));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group category
     */
    public function it_endpoint_get_list_find_base_response_400(): void
    {
        // Arrange
        $category = $this->category();
        $data = [
           'id' => $category['id'],
           'active' => null
        ];
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('category.list.find', $data));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
