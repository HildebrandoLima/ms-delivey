<?php

namespace Tests\Feature\Category;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListCategoryAllTest extends TestCase
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
        Fornecedor::factory(10)->create();
        $response = $this->getJson(route('category.list.all'));
        $response->assertStatus(200);
    }
}
