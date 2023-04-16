<?php

namespace Tests\Feature\Provider;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_delete_create_a_successful_response(): void
    {
        $response = $this->deleteJson('/api/provider/remove', [2]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_delete_create_a_failure_response(): void
    {
        $response = $this->deleteJson('/api/provider/remove', []);
        $response->assertStatus(422);
    }
}
