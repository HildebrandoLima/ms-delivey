<?php

namespace App\DataTransferObjects\MappersDtos;

use App\DataTransferObjects\Dtos\PaymentDto;

class PaymentMapperDto
{
    public static function mapper(array $payment): PaymentDto
    {
        return new PaymentDto
        (
            $payment['id'] ?? 0,
            $payment['codigo_transacao'] ?? 0,
            $payment['numero_cartao'] ?? '',
            $payment['data_validade'] ?? '',
            $payment['parcela'] ?? 0,
            $payment['total'] ?? 0,
            $payment['metodo_pagamento_id'] ?? 0,
            $payment['pedido_id'] ?? 0,
            $payment['ativo'] ?? '',
            $payment['created_at'] ?? '',
            $payment['updated_at'] ?? '',
        );
    }
}
