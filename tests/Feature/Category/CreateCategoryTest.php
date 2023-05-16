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
        //
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        $category = Categoria::factory(1)->createOne();
        $data = $category->toArray();
        $response = $this->postJson(route('category.save', $data));
        $response->assertStatus(200);
    }
}
