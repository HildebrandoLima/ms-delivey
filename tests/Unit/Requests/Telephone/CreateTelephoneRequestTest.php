<?php

namespace Tests\Unit\Requests\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use Tests\TestCase;

class CreateTelephoneRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new CreateTelephoneRequest();

        // Act
        $data = [
            'telefones' => 'required|array',
            'telefones.*.numero' => 'required|string|Celular|unique:telefone,numero|min:10|max:10',
            'telefones.*.tipo' => 'required|string',
            'telefones.*.dddId' => 'required|int|exists:ddd,id',
            'telefones.*.usuarioId' => 'int|exists:users,id',
            'telefones.*.fornecedorId' => 'int|exists:fornecedor,id',
            'telefones.*.ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
