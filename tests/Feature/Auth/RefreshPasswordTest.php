<?php

namespace Tests\Feature\Auth;

use App\Models\PasswordReset;
use App\Support\Generate\GeneratePassword;
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
            'token' => $reset['token'],
            'codigo' => $reset['codigo'],
            'senha' => GeneratePassword::generatePassword()
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
        $data = [
            'codigo' => null,
            'password' => GeneratePassword::generatePassword()
        ];

        // Act
        $response = $this->postJson(route('auth.refresh', Str::uuid()), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
