<?php

namespace Tests\Unit\Requests\Address;

use App\Http\Requests\Address\CreateAddressRequest;
use Tests\TestCase;

class CreateAddressRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new CreateAddressRequest();

        // Act
        $data = [
            'logradouro' => 'required|string',
            'descricao' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'cep' => 'required|string|formato_cep|min:9|max:9',
            'ufId' => 'required|int|exists:unidade_federativa,id',
            'usuarioId' => 'int|exists:users,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
