<?php

namespace App\Services\Payment;

use App\Http\Requests\PaymentRequest;
use App\Models\Pagamento;
use App\Repositories\PaymentRepository;
use App\Services\Payment\Interfaces\ICreatePaymentService;
use App\Support\Utils\Enums\PaymentEnums;

class CreatePaymentService implements ICreatePaymentService
{
    private PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment(PaymentRequest $request): bool
    {
        $payment = $this->mapToModel($request);
        return $this->paymentRepository->insert($payment);
    }

    private function mapToModel(PaymentRequest $request): Pagamento
    {
        $payment = new Pagamento();
        $payment->codigo_transacao = random_int(100000000, 999999999);
        $payment->numero_cartao = $request->numeroCartao;
        $payment->data_validade = $request->dataValidade;
        $payment->parcela = $request->parcela;
        $payment->total = $request->total;
        $payment->ativo = PaymentEnums::ATIVADO;
        $payment->metodo_pagamento_id = $request->metodoPagamentoId;
        $payment->pedido_id = $request->pedidoId;
        return $payment;
    }
}
