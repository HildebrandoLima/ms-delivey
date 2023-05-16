<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUserAllTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_all_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_successful_response(): void
    {
        User::factory(100)->create();
        $response = $this->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10]));
        $response->assertOk();
    }
}
