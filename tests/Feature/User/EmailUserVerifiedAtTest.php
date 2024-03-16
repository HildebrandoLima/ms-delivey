<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\Models\User;
use Tests\TestCase;

class EmailUserVerifiedAtTest extends TestCase
{
    private function user(): array
    {
        return User::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_base_response_200(): void
    {
        // Arrange
        $data = $this->user();

        // Act
        $response = $this->getJson(route('user.email.verified', ['id' => $data['id']]));

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group user
     */
    public function it_endpoint_get_base_response_400(): void
    {
        // Arrange
        $data = 0;

        // Act
        $response = $this->getJson(route('user.email.verified', ['id' => $data]));

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
