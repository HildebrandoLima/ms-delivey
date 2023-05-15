<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        $user = User::factory(1)->create();
        $response = $this->post('/api/user/save', $user->toArray());
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_failure_response(): void
    {
        $user = User::factory(1)->create();
        $response = $this->post('/api/user/save', $user->toArray());
        $response->assertStatus(200);
    }
}
