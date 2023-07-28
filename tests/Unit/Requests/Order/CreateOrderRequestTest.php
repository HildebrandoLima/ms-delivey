<?php

namespace Tests\Unit\Requests\Order;

use App\Http\Requests\Order\CreateOrderRequest;
use Tests\TestCase;

class CreateOrderRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new CreateOrderRequest();

        // Act
        $data = [
            'quantidadeItens' => 'required|int',
            'total' => 'required|between:0,99.99',
            'entrega' => 'required|between:0,99.99',
            'usuarioId' => 'int|exists:users,id',
            'ativo' => 'required|boolean',
            'itens' => 'required|array',
            'itens.*.nome' => 'required|string',
            'itens.*.preco' => 'required|between:0,99.99',
            'itens.*.codigoBarra' => 'required|string|max:13|min:13',
            'itens.*.quantidadeItem' => 'required|int',
            'itens.*.subTotal' => 'required|between:0,99.99',
            'itens.*.unidadeMedida' => 'required|string',
            'itens.*.produtoId' => 'required|int|exists:produto,id',
            'itens.*.ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
