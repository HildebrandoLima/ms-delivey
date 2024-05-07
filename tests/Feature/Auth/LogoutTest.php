<?php

namespace Tests\Feature\Auth;

use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * @test
     * @group login
     */
    public function it_endpoint_post_logout_base_response_200(): void
    {
        // Arrange
        $authenticate = $this->authenticate(RoleEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('auth.logout'));

        // Assert
        $response->assertOk();
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group login
     */
    public function it_endpoint_post_logout_base_response_401(): void
    {
        // Arrange
        $authenticate = $this->bearerTokenInvalid();

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate,
        ])->postJson(route('auth.logout'));

        // Assert
        $response->assertUnauthorized();
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
