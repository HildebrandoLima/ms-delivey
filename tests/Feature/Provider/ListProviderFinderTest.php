<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProviderFinderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_find_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_a_successful_response(): void
    {
        $provider = Fornecedor::factory()->createOne();
        $data = $provider->toArray();
        $response = $this->getJson(route('provider.list.find', ['id' => base64_encode($data['id'])]));
        $response->assertOk();
    }
}
