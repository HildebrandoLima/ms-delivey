<?php

namespace App\Services\Payment;

use App\Http\Requests\PaymentRequest;
use App\Models\Pagamento;
use App\Repositories\PaymentRepository;
use App\Services\Payment\Interfaces\ICreatePaymentService;
use App\Support\Utils\Enums\PaymentEnum;
use Illuminate\Support\Carbon;

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
        $payment->numero_cartao = isset ($request->numeroCartao) ? str_replace(' ', "", $request->numeroCartao) : random_int(10000000000000, 99999999999999);
        $payment->data_validade = $request->dataValidade ?? Carbon::now()->format('Y-m-d H:i:s');
        $payment->parcela = $request->parcela ?? 0;
        $payment->total = $request->total;
        $payment->ativo = PaymentEnum::ATIVADO;
        $payment->metodo_pagamento_id = $request->metodoPagamentoId;
        $payment->pedido_id = $request->pedidoId;
        return $payment;
    }
}
