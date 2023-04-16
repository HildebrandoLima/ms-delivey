<?php

namespace Tests\Feature\Address;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_delete_create_a_successful_response(): void
    {
        $response = $this->deleteJson('/api/address/remove', [2]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_delete_create_a_failure_response(): void
    {
        $response = $this->deleteJson('/api/address/remove', []);
        $response->assertStatus(404);
    }
}
