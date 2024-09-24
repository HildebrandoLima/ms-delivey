<?php

namespace App\Data\Repositories\Payment\Concretes;

use App\Data\Repositories\Payment\Interfaces\ICreatePaymentRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Pagamento;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class CreatePaymentRepository implements ICreatePaymentRepository
{
    use DefaultConditionActive;

    public function create(CreatePaymentRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Pagamento::query()
            ->create([
                'codigo_transacao' => random_int(100000000, 999999999),
                'numero_cartao' => $request->numeroCartao ?? null,
                'tipo_cartao' => $request->tipoCartao ?? 'NULL',
                'ccv' => $request->ccv ?? null,
                'data_validade' => $request->dataValidade ?? null,
                'parcela' => $request->parcela ?? null,
                'total' => $request->total,
                'metodo_pagamento' => $request->metodoPagamento,
                'pedido_id' => $request->pedidoId,
                'ativo' => $this->defaultConditionActive(true)
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
