<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_all_a_successful_response(): void
    {
        $response = $this->getJson('/api/provider/list', []);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_single_a_successful_response(): void
    {
        $response = $this->getJson('/api/provider/list/', [1]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_all_a_failure_response(): void
    {
        $response = $this->getJson('/api/provider/list', []);
        $response->assertStatus( 401);
    }

    /**
     * @test
     */
    public function it_endpoint_get_single_a_failure_response(): void
    {
        $response = $this->getJson('/api/provider/list', [1]);
        $response->assertStatus( 401);
    }
}
