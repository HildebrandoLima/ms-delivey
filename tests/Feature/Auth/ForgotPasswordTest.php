<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_forgot_password_base_response_200(): void
    {
        // Arrange
        $data = [
            'email' => 'hkohler@yahoo.com'
        ];

        // Act
        $response = $this->postJson(route('auth.forgot'), $data);

        // Assert
        $response->assertOk();
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_forgot_password_base_response_400(): void
    {
        // Arrange
        $data = [
            'email' => ''
        ];

        // Act
        $response = $this->postJson(route('auth.forgot'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
