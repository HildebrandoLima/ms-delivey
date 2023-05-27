<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class PaymentRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numeroCartao' => 'int|min:13|max:13',
            'dataValidade' => 'date',
            'parcela' => 'int',
            'total' => 'between:0,99.99',
            'ativo' => 'required|int',
            'metodoPagamentoId' => 'required|int|exists:metodo_pagamento,id',
            'pedidoId' => 'required|int|exists:pedido,id',
        ];
    }

    public function messages()
    {
        return [
            'metodoPagamentoId.exists' => DefaultErrorMessages::NOT_FOUND,
            'pedidoId.exists' => DefaultErrorMessages::NOT_FOUND,

            'numeroCartao.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'numeroCartao.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'metodoPagamentoId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'pedidoId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'numeroCartao.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'dataValidade.date' => DefaultErrorMessages::INVALID_DATE,
            'parcela.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'total.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'ativo.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'metodoPagamentoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'pedidoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
