<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_login_base_response_200(): void
    {
        // Arrange
        $data = [
            'email' => 'hildebrandolima16@gmail.com',
            'password' => 'HiLd3br@ndo'
        ];

        // Act
        $response = $this->postJson(route('auth.login'), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_login_base_response_400_email_invalid(): void
    {
        // Arrange
        $data = [
            'email' => 'hildebrandolima16@gmail',
            'password' => 'HiLd3br@ndo'
        ];

        // Act
        $response = $this->postJson(route('auth.login'), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_login_base_response_400_password_invalid(): void
    {
        // Arrange
        $data = [
            'email' => 'hildebrandolima16@gmail.com',
            'password' => 'HiLd3brndo'
        ];

        // Act
        $response = $this->postJson(route('auth.login'), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}