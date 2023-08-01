<?php

namespace App\Http\Requests\Payment;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Traits\ValidationPermission;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreatePaymentRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        $this->validationPermission(PermissionEnum::CRIAR_PAGAMENTO);
        return true;
    }

    public function rules(): array
    {
        return [
            'numeroCartao' => 'string|min:14|max:19',
            'dataValidade' => 'date',
            'parcela' => 'int',
            'total' => 'between:0,99.99',
            'metodoPagamentoId' => 'required|int|exists:metodo_pagamento,id',
            'pedidoId' => 'required|int|exists:pedido,id',
            'ativo' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'metodoPagamentoId.exists' => DefaultErrorMessages::NOT_FOUND,
            'pedidoId.exists' => DefaultErrorMessages::NOT_FOUND,

            'numeroCartao.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'numeroCartao.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'metodoPagamentoId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'pedidoId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'numeroCartao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'dataValidade.date' => DefaultErrorMessages::INVALID_DATE,
            'parcela.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'total.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'metodoPagamentoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'pedidoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
