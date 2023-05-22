<?php

namespace Tests\Feature\Product;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProductTest extends TestCase
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
        $product = Produto::factory()->createOne();
        $data = $product->toArray();
        $response = $this->putJson(route('product.edit', ['id' => $data['id']]), $data);
        $response->assertStatus(200);
    }
}
