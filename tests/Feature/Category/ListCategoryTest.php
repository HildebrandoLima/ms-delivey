<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListCategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_all_successful_response(): void
    {
        $response = $this->getJson('/api/category/list');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_successful_response(): void
    {
        $response = $this->getJson('/api/category/list/', [2]);
        $response->assertStatus(200);
    }
}
