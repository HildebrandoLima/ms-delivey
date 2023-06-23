<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\PaymentDto;
use App\Http\Requests\PaymentRequest;
use App\Support\Utils\Enums\PaymentEnum;

class PaymentRequestDto
{
    public static function fromRquest(PaymentRequest $request): PaymentDto
    {
        $paymentDto = new PaymentDto();
        $paymentDto->setCodigoTransacao(random_int(100000000, 999999999));
        $paymentDto->setNumeroCartao(str_replace(' ', "", $request['numeroCartao']) ?? null);
        $paymentDto->setDataValidade($request['dataValidade'] ?? null);
        $paymentDto->setParcela($request['parcela'] ?? null);
        $paymentDto->setTotal($request['total']);
        $paymentDto->setMetodoPagamentoId($request['metodoPagamentoId']);
        $paymentDto->setPedidoId($request['pedidoId']);
        $paymentDto->setAtivo(PaymentEnum::ATIVADO);
        return $paymentDto;
    }
}
