<?php

namespace Tests\Feature\Auth;

use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_logout_base_response_200(): void
    {
        // Arrange
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('auth.logout'));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_logout_base_response_401(): void
    {
        // Arrange
        #

        // Act
        $response = $this->postJson(route('auth.logout'));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
