<?php

namespace App\Services\Payment\Concretes;

use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Pagamento;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Payment\Abstracts\ICreatePaymentService;
use App\Support\Enums\AtivoEnum;

class CreatePaymentService implements ICreatePaymentService
{
    private IEntityRepository $paymentRepository;

    public function __construct(IEntityRepository $paymentRepository)
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
        $payment->numero_cartao = $request->numeroCartao ?? null;
        $payment->ccv = $request->ccv ?? null;
        $payment->data_validade = $request->dataValidade ?? null;
        $payment->parcela = $request->parcela ?? null;
        $payment->total = $request->total;
        $payment->metodo_pagamento_id = $request->metodoPagamentoId;
        $payment->pedido_id = $request->pedidoId;
        $payment->ativo = AtivoEnum::ATIVADO;
        return $payment;
    }
}
