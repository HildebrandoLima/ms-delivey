<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_all_a_successful_response(): void
    {
        $response = $this->getJson('/api/user/list', []);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_single_a_successful_response(): void
    {
        $response = $this->getJson('/api/user/list/', [1]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_a_failure_response(): void
    {
        $response = $this->getJson('/api/user/list', []);
        $response->assertStatus( 401);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_single_a_failure_response(): void
    {
        $response = $this->getJson('/api/user/list', [1]);
        $response->assertStatus( 401);
    }
}
