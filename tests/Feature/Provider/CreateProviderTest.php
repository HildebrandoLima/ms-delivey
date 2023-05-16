<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_create_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_a_successful_response(): void
    {
        $provider = Fornecedor::factory()->createOne();
        $data = $provider->toArray();
        $response = $this->postJson(route('provider.save'), $data);
        $response->assertStatus(200);
    }
}
