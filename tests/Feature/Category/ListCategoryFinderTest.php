<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListCategoryFinderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_all_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_successful_response(): void
    {
        $category = Categoria::factory()->createOne();
        $data = $category->toArray();
        $response = $this->getJson(route('category.list.find', ['id' => base64_encode($data['id'])]));
        $response->assertStatus(200);
    }
}
