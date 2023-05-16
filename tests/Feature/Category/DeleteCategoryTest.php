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
        //
    }

    /**
     * @test
     */
    public function it_endpoint_delete_remove_a_successful_response(): void
    {
        $category = Categoria::factory(1)->createOne();
        $data = $category->toArray();
        $response = $this->deleteJson(route('category.remove', ['id' => base64_encode($data['id'])]));
        $response->assertStatus(200);
    }
}
