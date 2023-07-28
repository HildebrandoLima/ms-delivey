<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\User\EditUserRequest;
use Tests\TestCase;

class EditUserRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new EditUserRequest();

        // Act
        $data = [
            'id' => 'required|int|exists:users,id',
            'nome' => 'required|string',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'genero' => 'required|string',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
