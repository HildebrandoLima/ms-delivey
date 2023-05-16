<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_create_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        $user = User::factory()->makeOne();
        $data = $user->toArray();
        $response = $this->postJson(route('user.save'), $data);
        $response->assertStatus(200);
    }
}
