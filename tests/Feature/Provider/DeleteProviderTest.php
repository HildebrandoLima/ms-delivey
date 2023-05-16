<?php

namespace Tests\Feature\Provider;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProviderTest extends TestCase
{
    /**
     * @test
    */
    public function it_endpoint_delete_remove_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_delete_remove_a_successful_response(): void
    {
        $provider = Fornecedor::factory()->createOne();
        $data = $provider->toArray();
        $response = $this->deleteJson(route('provider.remove', ['id' => base64_encode($data['id'])]));
        $response->assertStatus(200);
    }
}
