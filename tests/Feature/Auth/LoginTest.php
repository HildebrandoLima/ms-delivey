<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @test
     * @group login
     */
    public function it_endpoint_post_login_base_response_200(): void
    {
        // Arrange
        $data = [
            'email' => 'cliente@gmail.com',
            'password' => '@PClient5'
        ];

        // Act
        $response = $this->postJson(route('auth.login'), $data);

        // Assert
        $response->assertOk();
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group login
     */
    public function it_endpoint_post_login_email_invalid_base_response_400(): void
    {
        // Arrange
        $data = [
            'email' => null,
            'password' => '@PClient5'
        ];

        // Act
        $response = $this->postJson(route('auth.login'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group login
     */
    public function it_endpoint_login_password_invalid_base_response_400(): void
    {
        // Arrange
        $data = [
            'email' => 'cliente@gmail.com',
            'password' => '@Client'
        ];

        // Act
        $response = $this->postJson(route('auth.login'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group login
     */
    /*
    public function it_endpoint_post_login_first_access_base_response_400(): void
    {
        // Arrange
        $data = [
            'email' => $this->emailVerifiedAt(),
            'password' => null
        ];

        // Act
        $response = $this->postJson(route('auth.login'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
    */
}
