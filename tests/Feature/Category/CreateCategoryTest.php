<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_create_a_failure_response(): void
    {
        $category = Categoria::query()->where('id', 2)->get();
        $response = $this->postJson('/api/category/save', $category->toArray());
        $this->assertEquals($response->original['status'], 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        $category = Categoria::factory(1)->create();
        $response = $this->postJson('/api/category/save', $category->toArray());
        $response->assertStatus(200);
    }
}
