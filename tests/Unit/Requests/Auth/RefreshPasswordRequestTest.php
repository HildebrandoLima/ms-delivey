<?php

namespace Tests\Unit\Requests\Auth;

use App\Http\Requests\Auth\RefreshPasswordRequest;
use Tests\TestCase;

class RefreshPasswordRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new RefreshPasswordRequest();

        // Act
        $data = [
            'token' => 'required|string|exists:password_resets,token',
            'codigo' => 'required|string|min:10|max:10|exists:password_resets,codigo',
            'senha' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i'
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
