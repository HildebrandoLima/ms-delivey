<?php

namespace Tests\Feature\Address;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_uf_a_successful_response(): void
    {
        $response = $this->getJson('/api/address/uf/list');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_address_a_successful_response(): void
    {
        $response = $this->getJson('/api/address/list', [1]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_uf_a_failure_response(): void
    {
        $response = $this->getJson('/api/address/uf/list');
        $response->assertStatus( 401);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_address_a_failure_response(): void
    {
        $response = $this->getJson('/api/address/list/', [3000]);
        $response->assertStatus( 400);
    }
}
