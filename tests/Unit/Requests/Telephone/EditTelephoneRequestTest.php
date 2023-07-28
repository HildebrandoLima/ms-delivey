<?php

namespace Tests\Unit\Requests\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use Tests\TestCase;

class EditTelephoneRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new EditTelephoneRequest();

        // Act
        $data = [
            'id' => 'required|int|exists:telefone,id',
            'numero' => 'required|string|Celular|min:10|max:10',
            'tipo' => 'required|string',
            'dddId' => 'required|int|exists:ddd,id',
            'usuarioId' => 'int|exists:users,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
