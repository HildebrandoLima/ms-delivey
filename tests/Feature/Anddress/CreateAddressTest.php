<?php

namespace Tests\Feature\Address;

use App\Models\Endereco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAddressTest extends TestCase
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
        $address = Endereco::factory(1)->createOne();
        $data = $address->toArray();
        $response = $this->postJson(route('address.save'), $data);
        $response->assertStatus(200);
    }
}
