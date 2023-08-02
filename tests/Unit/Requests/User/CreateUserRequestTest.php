<?php

namespace Tests\Unit\Requests\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Support\Enums\UserEnum;
use Tests\TestCase;

class CreateUserRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new CreateUserRequest();

        // Act
        $data = [
            'nome' => 'required|string|unique:users,nome',
            'cpf' => 'required|string|formato_cpf|unique:users,cpf|min:14|max:14',
            'email' => 'required|string|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'senha' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i',
            'dataNascimento' => 'required|date',
            'genero' => 'required|string|in:' . UserEnum::GENERO_MASCULINO . ',' . UserEnum::GENERO_FEMININO . ',' . UserEnum::GENERO_OUTRO,
            'eAdmin' => 'required|boolean',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }   
}
