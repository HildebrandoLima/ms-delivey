<?php

namespace Tests\Feature\Address;

use App\Models\UnidadeFederativa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUFTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_uf_base_response_200(): void
    {
        // Arrange
        $data = UnidadeFederativa::query()->get()->toArray();

        // Act
        $response = $this->getJson(route('address.uf.list'));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(27, count($data));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
