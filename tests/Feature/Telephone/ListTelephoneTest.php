<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_telephone_a_failure_response(): void
    {
       //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_telephone_a_successful_response(): void
    {
        $telephone = Telefone::factory(1)->create();
        $data = $telephone->toArray();
        $response = $this->getJson(route('telephone.list', ['id' => base64_encode($data['id'])]));
        $response->assertOk();
    }
}
