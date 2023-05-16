<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_delete_remove_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_delete_remove_a_successful_response(): void
    {
        $user = User::factory()->createOne();
        $data = $user->toArray();
        $response = $this->deleteJson(route('user.remove', ['id' => base64_encode($data['id'])]));
        $response->assertStatus(200);
    }
}
