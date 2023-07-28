<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Provider\EditProviderRequest;
use Tests\TestCase;

class EditProviderRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new EditProviderRequest();

        // Act
        $data = [
            'id' => 'required|int|exists:fornecedor,id',
            'razaoSocial' => 'required|string',
            'cnpj' => 'required|string|formato_cnpj',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'ativo' => 'required|boolean'
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
