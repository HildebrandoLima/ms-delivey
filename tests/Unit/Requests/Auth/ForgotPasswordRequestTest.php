<?php

namespace Tests\Unit\Requests\Auth;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use Tests\TestCase;

class ForgotPasswordRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new ForgotPasswordRequest();

        // Act
        $data = [
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i|min:8|exists:users,email',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
