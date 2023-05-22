<?php

namespace Tests\Feature\Product;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProductTest extends TestCase
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
        $user = Produto::factory()->createOne();
        $data = $user->toArray();
        $response = $this->deleteJson(route('product.remove', ['id' => base64_encode($data['id'])]));
        $response->assertStatus(200);
    }
}
