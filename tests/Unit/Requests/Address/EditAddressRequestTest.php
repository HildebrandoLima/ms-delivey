<?php

namespace Tests\Unit\Requests\Address;

use App\Http\Requests\Address\EditAddressRequest;
use App\Support\Enums\AddressEnum;
use Tests\TestCase;

class EditAddressRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new EditAddressRequest();

        // Act
        $data = [
            'id' => 'required|int|exists:endereco,id',
            'logradouro' => 'required|string|in:' . AddressEnum::LOGRADOURO_RUA . ',' . AddressEnum::LOGRADOURO_AVENIDA,
            'descricao' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'cep' => 'required|string|formato_cep|min:9|max:9',
            'uf' => 'required|string|uf',
            'usuarioId' => 'int|exists:users,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
