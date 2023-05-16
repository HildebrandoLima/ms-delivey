<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditAddressTest extends TestCase
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
        $address = Endereco::factory()->createOne();
        $data = $address->toArray();
        $response = $this->putJson(route('address.edit', ['id' => base64_encode($data['id'])]), $data);
        $response->assertStatus(200);
    }
}
