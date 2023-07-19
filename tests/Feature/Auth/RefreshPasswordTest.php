<?php

namespace Tests\Feature\Auth;

use App\Models\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class RefreshPasswordTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_refresh_password_base_response_200(): void
    {
        // Arrange
        $reset = PasswordReset::query()->first()->toArray();
        $data = [
            'codigo' => $reset['codigo'],
            'password' => 'HiLd3br@ndo'
        ];

        // Act
        $response = $this->postJson(route('auth.refresh', $reset['token']), $data);

        // Assert
        $response->assertOk();
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_refresh_password_base_response_400(): void
    {
        // Arrange
        $reset = PasswordReset::query()->first()->toArray();
        $data = [
            'codigo' => $reset['codigo'],
            'password' => 'HiLd3br@ndo'
        ];

        // Act
        $response = $this->postJson(route('auth.refresh', Str::uuid()), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
