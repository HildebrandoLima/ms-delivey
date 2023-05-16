<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProviderAllTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_all_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_a_successful_response(): void
    {
        Fornecedor::factory()->createOne();
        $response = $this->getJson(route('provider.list.all', ['page' => 1, 'perPage' => 10]));
        $response->assertOk();
    }
}
