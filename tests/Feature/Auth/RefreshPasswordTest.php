<?php

namespace Tests\Feature\Auth;

use App\Models\PasswordReset;
use App\Models\User;
use App\Support\Traits\GeneratePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RefreshPasswordTest extends TestCase
{
    use GeneratePassword;

    /**
     * @test
     */
    public function it_endpoint_post_refresh_password_base_response_200(): void
    {
        // Arrange
        $user = User::factory()->createOne();
        PasswordReset::factory()->createOne(['email' => $user['email']]);
        $reset = PasswordReset::query()->first()->toArray();
        $data = [
            'token' => $reset['token'],
            'codigo' => $reset['codigo'],
            'senha' => $this->generatePassword()
        ];

        // Act
        $response = $this->postJson(route('auth.refresh'), $data);

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
            'token' => null,
            'codigo' => null,
            'password' => $this->generatePassword()
        ];

        // Act
        $response = $this->postJson(route('auth.refresh'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
