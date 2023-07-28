<?php

namespace Tests\Unit\Requests\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new LoginRequest();

        // Act
        $data = [
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i|min:8|exists:users,email',
            'password' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i'
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
