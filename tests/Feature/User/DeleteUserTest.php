<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_delete_remove_a_successful_response(): void
    {
        $response = $this->deleteJson('/api/user/remove', [1]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_delete_remove_a_failure_response(): void
    {
        $response = $this->deleteJson('/api/user/remove', [2235]);
        $response->assertStatus(204);
    }
}
