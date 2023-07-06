<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListDDDTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_ddd_base_response_200(): void
    {
        // Arrange
        $data = Telefone::query()->get()->toArray();

        // Act
        $response = $this->getJson(route('telephone.ddd.list'));

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals(23, count($data));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }
}
