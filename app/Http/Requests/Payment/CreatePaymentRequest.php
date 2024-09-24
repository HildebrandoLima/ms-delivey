<?php

namespace App\Http\Requests\Payment;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PaymentEnum;
use App\Support\Enums\PermissionEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreatePaymentRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::CRIAR_PAGAMENTO);
    }

    public function rules(): array
    {
        return [
            'numeroCartao' => 'string|min:14|max:19',
            'tipoCartao' => 'string|in:' . PaymentEnum::CREDITO . ',' . PaymentEnum::DEBITO,
            'ccv' => 'int',
            'dataValidade' => 'date',
            'parcela' => 'int',
            'total' => 'between:0,99.99',
            'metodoPagamento' => 'required|string|in:' . PaymentEnum::BOLETO_BANCARIO . ',' . PaymentEnum::CREDITO .
            ',' . PaymentEnum::DEBITO . ',' . PaymentEnum::PIX,
            'pedidoId' => 'required|int|exists:pedido,id',
        ];
    }

    public function messages(): array
    {
        return [
            'pedidoId.exists' => DefaultErrorMessages::NOT_FOUND,
            'tipoCartao.in' => DefaultErrorMessages::NOT_FOUND,
            'metodoPagamento.in' => DefaultErrorMessages::NOT_FOUND,

            'numeroCartao.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'numeroCartao.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'metodoPagamento.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'pedidoId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'numeroCartao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'tipoCartao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'ccv.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'dataValidade.date' => DefaultErrorMessages::INVALID_DATE,
            'parcela.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'total.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'metodoPagamento.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'pedidoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
