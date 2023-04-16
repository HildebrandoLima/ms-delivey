<?php

namespace Tests\Feature\Telephone;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_delete_create_a_successful_response(): void
    {
        $response = $this->deleteJson('/api/telephone/remove', [2]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_delete_create_a_failure_response(): void
    {
        $response = $this->deleteJson('/api/telephone/remove', []);
        $response->assertStatus(404);
    }
}
