<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Provider\CreateProviderRequest;
use Tests\TestCase;

class CreateProviderRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new CreateProviderRequest();

        // Act
        $data = [
            'razaoSocial' => 'required|string|unique:fornecedor,razao_social',
            'cnpj' => 'required|string|formato_cnpj|unique:fornecedor,cnpj',
            'email' => 'required|string|unique:fornecedor,email|regex:/(.+)@(.+)\.(.+)/i',
            'dataFundacao' => 'required|date',
            'ativo' => 'required|boolean'
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
