<?php

namespace Tests\Unit\Requests\Telephone;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Support\Enums\TelephoneEnum;
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
            'telefones.*.numero' => 'required|string|celular_com_ddd|unique:telefone,numero|min:14|max:14',
            'telefones.*.tipo' => 'required|string|in:' . TelephoneEnum::TIPO_FIXO . ',' . TelephoneEnum::TIPO_CELULAR,
            'telefones.*.usuarioId' => 'int|exists:users,id',
            'telefones.*.fornecedorId' => 'int|exists:fornecedor,id',
            'telefones.*.ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
