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
    public function it_endpoint_put_update_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_a_successful_response(): void
    {
        $category = Categoria::factory(1)->createOne();
        $data = $category->toArray();
        $response = $this->putJson(route('category.edit', ['id' => base64_encode($data['id'])]), $data);
        $response->assertStatus(200);
    }
}
