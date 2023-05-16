<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteAddressTest extends TestCase
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
        $address = Endereco::factory()->createOne();
        $data = $address->toArray();
        $response = $this->deleteJson(route('address.remove', ['id' => base64_encode($data['id'])]));
        $response->assertStatus(200);
    }
}
