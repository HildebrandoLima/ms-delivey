<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListAddressTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_address_a_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_address_a_successful_response(): void
    {
        $address = Endereco::factory()->createOne();
        $data = $address->toArray();
        $response = $this->getJson(route('address.list', ['id' => base64_encode($data['id'])]));
        $response->assertOk();
    }
}
