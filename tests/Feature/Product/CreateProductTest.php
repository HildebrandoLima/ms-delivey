<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Produto;
use Tests\TestCase;

class CreateProductTest extends TestCase
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
        $product = Produto::factory()->makeOne();
        $data = $product->toArray();
        $response = $this->postJson(route('product.save'), $data);
        $response->assertStatus(200);
    }
}
