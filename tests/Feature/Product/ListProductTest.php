<?php

namespace Tests\Feature\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_find_failure_response(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_successful_response(): void
    {
        $product = User::factory()->createOne();
        $data = $product->toArray();
        $response = $this->getJson(route('product.list.find', ['id' => base64_encode($data['id'])]));
        $response->assertOk();
    }
}
