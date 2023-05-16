<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTelephoneTest extends TestCase
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
        $telephone = Telefone::factory()->createOne();
        $data = $telephone->toArray();
        $response = $this->putJson(route('telephone.edit', ['id' => $data['id']]), $data);
        $response->assertStatus(200);
    }
}
