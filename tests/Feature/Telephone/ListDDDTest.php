<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListDDDTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_ddd_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_ddd_a_successful_response(): void
    {
        $response = $this->getJson(route('telephone.ddd.list'));
        $response->assertOk();
    }
}
