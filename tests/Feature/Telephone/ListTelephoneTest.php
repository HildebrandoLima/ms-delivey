<?php

namespace Tests\Feature\Telephone;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_ddd_a_successful_response(): void
    {
        $response = $this->getJson('/api/telephone/ddd/list');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_telephone_a_successful_response(): void
    {
        $response = $this->getJson('/api/telephone/list', [1]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_ddd_a_failure_response(): void
    {
        $response = $this->getJson('/api/telephone/ddd/list');
        $response->assertStatus( 401);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_telephone_a_failure_response(): void
    {
        $response = $this->getJson('/api/telephone/list/', [33]);
        $response->assertStatus( 400);
    }
}
