<?php

namespace App\Domains\Services\Payment\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Payment\Abstracts\ICreatePaymentService;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Pagamento;
use App\Support\Enums\ActiveEnum;

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

    public function map(CreatePaymentRequest $request): Pagamento
    {
        $payment = new Pagamento();
        $payment->codigo_transacao = random_int(100000000, 999999999);
        $payment->numero_cartao = $request->numeroCartao ?? null;
        $payment->tipo_cartao = $request->tipoCartao ?? 'NULL';
        $payment->ccv = $request->ccv ?? null;
        $payment->data_validade = $request->dataValidade ?? null;
        $payment->parcela = $request->parcela ?? null;
        $payment->total = $request->total;
        $payment->metodo_pagamento = $request->metodoPagamento;
        $payment->pedido_id = $request->pedidoId;
        $payment->ativo = ActiveEnum::ATIVADO;
        return $payment;
    }
}
