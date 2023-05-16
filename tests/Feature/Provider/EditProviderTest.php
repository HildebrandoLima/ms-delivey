<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_update_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_a_successful_response(): void
    {
        $provider = Fornecedor::factory()->createOne();
        $data = $provider->toArray();
        $response = $this->putJson(route('provider.edit', ['id' => base64_encode($data['id'])]), $data);
        $response->assertStatus(200);
    }
}
