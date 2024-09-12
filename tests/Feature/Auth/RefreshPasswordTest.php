<?php

namespace Tests\Feature\Auth;

use App\Domains\Traits\GenerateData\GeneratePassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RefreshPasswordTest extends TestCase
{
    use GeneratePassword;

    /**
     * @test
     * @group login
     */
    public function it_endpoint_post_refresh_password_base_response_200(): void
    {
        // Arrange
        $email = User::query()->first()->email;
        PasswordReset::factory()->createOne(['email' => $email]);
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
     * @group login
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
