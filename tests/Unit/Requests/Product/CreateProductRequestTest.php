<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Product\CreateProductRequest;
use Tests\TestCase;

class CreateProductRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new CreateProductRequest();

        // Act
        $data = [
            'nome' => 'required|string|unique:produto,nome',
            'precoCusto' => 'required|between:0,99.99',
            'precoVenda' => 'required|between:0,99.99',
            'codigoBarra' => 'required|string|min:13|max:13|unique:produto,codigo_barra',
            'descricao' => 'required|string',
            'quantidade' => 'required|int',
            'unidadeMedida' => 'required|string',
            'dataValidade' => 'required|date',
            'categoriaId' => 'required|int|exists:categoria,id',
            'fornecedorId' => 'required|int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
            'imagens' => 'required|array',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
