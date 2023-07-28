<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Payment\CreatePaymentRequest;
use Tests\TestCase;

class CreatePaymentRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new CreatePaymentRequest();

        // Act
        $data = [
            'numeroCartao' => 'string|min:14|max:19',
            'dataValidade' => 'date',
            'parcela' => 'int',
            'total' => 'between:0,99.99',
            'metodoPagamentoId' => 'required|int|exists:metodo_pagamento,id',
            'pedidoId' => 'required|int|exists:pedido,id',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
