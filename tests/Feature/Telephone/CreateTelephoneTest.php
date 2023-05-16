<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTelephoneTest extends TestCase
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
        $telephone = Telefone::factory(3)->make();
        $data = $telephone->toArray();
        $response = $this->postJson(route('telephone.save'), $data);
        $response->assertStatus(200);
    }
}
