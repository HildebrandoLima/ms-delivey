<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTelephoneTest extends TestCase
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
        $telephone = Telefone::factory()->createOne();
        $data = $telephone->toArray();
        $response = $this->deleteJson(route('telephone.remove', ['id' => base64_encode($data['id'])]));
        $response->assertStatus(200);
    }
}
