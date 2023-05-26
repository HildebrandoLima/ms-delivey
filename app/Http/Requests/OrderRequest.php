<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class OrderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numeroPedido' => 'required|int',
            'quantidadeItem' => 'required|int',
            'total' => 'required|between:0,99.99',
            'entrega' => 'required|string',
            'ativo' => 'required|int',
            'usuarioId' => 'int|exists:usuario,id',
        ];
    }

    public function messages()
    {
        return [
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,

            'numeroPedido.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'quantidadeItem.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'total.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'entrega.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'usuarioId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'numeroPedido.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'quantidadeItem.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'total.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'entrega.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'ativo.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
