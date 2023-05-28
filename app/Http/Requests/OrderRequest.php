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
            'totalItems' => 'required|int',
            'total' => 'required|between:0,99.99',
            'entrega' => 'required|between:0,99.99',
            'usuarioId' => 'int|exists:users,id',
            'ativo' => 'required|int',
            'items' => 'required|array',
            'items.*.nome' => 'required|string',
            'items.*.preco' => 'required|between:0,99.99',
            'items.*.codigoBarra' => 'required|string|max:13|min:13',
            'items.*.quantidadeItem' => 'required|int',
            'items.*.subTotal' => 'required|between:0,99.99',
            'items.*.unidadeMedida' => 'required|string',
            'items.*.produtoId' => 'required|int|exists:produto,id',
            'items.*.ativo' => 'required|int',
        ];
    }

    public function messages()
    {
        return [
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'produtoId.exists' => DefaultErrorMessages::NOT_FOUND,

            'totalItems.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'total.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'entrega.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'usuarioId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'codigoBarra.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'codigoBarra.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'items.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'preco.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'codigoBarra.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'quantidadeItem.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'subTotal.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'unidadeMedida.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'produtoId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'totalItems.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'total.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'entrega.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,

            'items.array' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'preco.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'codigoBarra.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'quantidadeItem.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'subTotal.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'unidadeMedida.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'produtoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
