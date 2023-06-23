<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\PaymentDto;

class PaymentMapperDto
{
    public static function mapper(array $payment): PaymentDto
    {
        return PaymentDto::construction()
        ->setPagamentoId($payment['id'] ?? 0)
        ->setNumeroCartao($payment['numero_cartao'] ?? '')
        ->setDataValidade($payment['data_validade'] ?? '')
        ->setParcela($payment['parcela'] ?? 0)
        ->setTotal($payment['total'] ?? 0)
        ->setMetodoPagamentoId($payment['metodo_pagamento_id'] ?? 0)
        ->setPedidoId($payment['pedido_id'] ?? 0)
        ->setAtivo($payment['ativo'] ?? '')
        ->setCriadoEm($payment['created_at'] ?? '')
        ->setAlteradoEm($payment['updated_at'] ?? '');
    }
}
