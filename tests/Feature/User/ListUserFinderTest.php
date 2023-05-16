<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUserFinderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_find_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_successful_response(): void
    {
        $user = User::factory()->createOne();
        $data = $user->toArray();
        $response = $this->getJson(route('user.list.find', ['id' => base64_encode($data['id'])]));
        $response->assertOk();
    }
}
