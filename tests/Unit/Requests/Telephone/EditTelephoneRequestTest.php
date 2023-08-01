<?php

namespace Tests\Unit\Requests\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Support\Enums\TelephoneEnum;
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
            'numero' => 'required|string|celular_com_ddd|min:14|max:14',
            'telefones.*.tipo' => 'required|string|in:' . TelephoneEnum::TIPO_CELULAR . ',' . TelephoneEnum::TIPO_CELULAR,
            'usuarioId' => 'int|exists:users,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
