<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditCategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_update_a_successful_response(): void
    {
        $category = Categoria::factory(1)->create();
        $response = $this->putJson('/api/category/edit', $category);
        $response->assertStatus(200);
    }
}
