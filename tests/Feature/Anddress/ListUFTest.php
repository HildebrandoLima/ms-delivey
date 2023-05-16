<?php

namespace Tests\Feature\Address;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUFTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_uf_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_uf_a_successful_response(): void
    {
        $response = $this->getJson(route('address.uf.list'));
        $response->assertOk();
    }
}
