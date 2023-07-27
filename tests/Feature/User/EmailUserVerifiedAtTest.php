<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class EmailUserVerifiedAtTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_base_response_200(): void
    {
        // Arrange
        $data = User::query()->first()->toArray();

        // Act
        $response = $this->getJson(route('user.email.verified', ['id' => $data['id'], 'active' => $data['ativo']]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_base_response_400(): void
    {
        // Arrange
        $data = User::query()->first()->toArray();

        // Act
        $response = $this->getJson(route('user.email.verified', ['id' => $data['id']]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
