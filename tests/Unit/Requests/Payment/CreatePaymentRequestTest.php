<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Pedido;
use Tests\TestCase;

class CreatePaymentRequestTest extends TestCase
{
    private CreatePaymentRequest $request;

    private function request(): CreatePaymentRequest
    {
        $this->request = new CreatePaymentRequest();
        $this->request['numeroCartao'] = rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200);
        $this->request['dataValidade'] =  date('Y-m-d H:i:s');
        $this->request['parcela'] = rand(0, 2);
        $this->request['total'] = 10.5;
        $this->request['metodoPagamentoId'] = 2;
        $this->request['pedidoId'] = Pedido::factory()->createOne()->id;
        $this->request['ativo'] = true;
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

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
        $this->assertEquals($data, $this->request()->rules());
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultTotal = isset($this->request['total']);
        $methodPaymentId = isset($this->request['metodoPagamentoId']);
        $resultOrderId = isset($this->request['pedidoId']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultTotal);
        $this->assertTrue($methodPaymentId);
        $this->assertTrue($resultOrderId);
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultNumberCard = is_string($this->request['numeroCartao']);
        $resultExpirationDate = is_string($this->request['dataValidade']);
        $resultPortion = is_int($this->request['parcela']);
        $resultTotal = is_float($this->request['total']);
        $methodPaymentId = is_int($this->request['metodoPagamentoId']);
        $resultOrderId = is_int($this->request['pedidoId']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultNumberCard);
        $this->assertTrue($resultExpirationDate);
        $this->assertTrue($resultPortion);
        $this->assertTrue($resultTotal);
        $this->assertTrue($methodPaymentId);
        $this->assertTrue($resultOrderId);
        $this->assertTrue($resultActive);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $this->request();
        $this->request['numeroCartao'] = str_replace(' ', "", rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200));

        // Act
        if ($this->request['numeroCartao'] != $this->mask($this->request['numeroCartao'], "#### #### #### ####")):
            $resultNumberCard = true;
        endif;

        // Assert
        $this->assertTrue($resultNumberCard);
    }

    public function test_request_exists(): void
    {
        // Arrange
        Pedido::factory()->createOne();
        $this->request();
        $this->request['pedidoId'] = Pedido::query()->first()->id;

        // Act
        $resultOrderId = isset($this->request['pedidoId']);

        // Assert
        $this->assertTrue($resultOrderId);
    }
}
