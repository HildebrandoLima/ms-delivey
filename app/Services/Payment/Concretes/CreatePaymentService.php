<?php

namespace App\Services\Payment\Concretes;

use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Pagamento;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\Payment\Interfaces\CreatePaymentServiceInterface;
use App\Support\Enums\PaymentEnum;

class CreatePaymentService implements CreatePaymentServiceInterface
{
    private PaymentRepositoryInterface $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment(CreatePaymentRequest $request): bool
    {
        $payment = $this->map($request);
        return $this->paymentRepository->create($payment);
    }

    private function map(CreatePaymentRequest $request): Pagamento
    {
        $payment = new Pagamento();
        $payment->codigo_transacao = random_int(100000000, 999999999);
        $payment->numero_cartao = str_replace(' ', "", $request->numeroCartao) ?? null;
        $payment->data_validade = $request->dataValidade ?? null;
        $payment->parcela = $request->parcela ?? null;
        $payment->total = $request->total;
        $payment->metodo_pagamento_id = $request->metodoPagamentoId;
        $payment->pedido_id = $request->pedidoId;
        $payment->ativo = PaymentEnum::ATIVADO;
        return $payment;
    }
}
