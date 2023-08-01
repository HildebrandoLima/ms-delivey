<?php

namespace Tests\Unit\Requests\Product;

use App\Http\Requests\Product\EditProductRequest;
use App\Support\Enums\ProductEnum;
use Tests\TestCase;

class EditProductRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new EditProductRequest();

        // Act
        $data = [
            'id' => 'int|exists:produto,id',
            'nome' => 'required|string',
            'precoCusto' => 'required|between:0,99.99',
            'precoVenda' => 'required|between:0,99.99',
            'codigoBarra' => 'required|string|min:13|max:13',
            'descricao' => 'required|string',
            'quantidade' => 'required|int',
            'unidadeMedida' => 'required|string|in:' . ProductEnum::UN . ',' . ProductEnum::G . ',' . ProductEnum::KG . ',' . ProductEnum::ML . ',' . ProductEnum::L . ',' . ProductEnum::M2 . ',' . ProductEnum::CX,
            'dataValidade' => 'required|date',
            'categoriaId' => 'int|exists:categoria,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
