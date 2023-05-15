<?php

namespace Tests\Feature\Category;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_delete_remove_a_failure_response(): void
    {
        //$category = Categoria::factory(1)->create();
        //$response = $this->deleteJson('/api/category/remove', $category->toArray()[0]['id']);
        //$this->assertEquals($response->original['status'], 400);
    }

    /**
     * @test
     */
    public function it_endpoint_delete_remove_a_successful_response(): void
    {
        $category = Categoria::factory(1)->create();
        $response = $this->deleteJson('/api/category/remove', $category->toArray());
        $response->assertStatus(200);
    }
}
