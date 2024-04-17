<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IntegrationViaCepTest extends TestCase
{
    /**
     * @test
     * @group address
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        $data = '60872-559';

        // Act
        $response = $this->getJson(route('integration.viacep', ['cep' => $data]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group address
     */
    public function it_endpoint_get_list_all_base_response_400(): void
    {
        // Arrange
        $data = '60872-55';

        // Act
        $response = $this->getJson(route('integration.viacep', ['cep' => $data]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
