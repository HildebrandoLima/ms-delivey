<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_update_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_a_successful_response(): void
    {
        $user = User::factory()->createOne();
        $data = $user->toArray();
        $response = $this->putJson(route('user.edit', ['id' => $data['id']]), $data);
        $response->assertStatus(200);
    }
}
