<?php

namespace App\Http\Requests\Order;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\OrderEnum;
use App\Support\Enums\PermissionEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateOrderRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::CRIAR_PEDIDO);
    }

    public function rules(): array
    {
        return [
            'quantidadeItens' => 'required|int',
            'total' => 'required|between:0,99.99',
            'tipoEntrega' => 'required|string|in:' . OrderEnum::EXPRESSO . ',' . OrderEnum::CORREIO . ',' . OrderEnum::RETIRADA,
            'valorEntrega' => 'required|between:0,99.99',
            'usuarioId' => 'int|exists:users,id',
            'enderecoId' => 'int|exists:endereco,id',
            'itens' => 'required|array',
            'itens.*.nome' => 'required|string|exists:produto,nome',
            'itens.*.preco' => 'required|between:0,99.99',
            'itens.*.quantidadeItem' => 'required|int',
            'itens.*.subTotal' => 'required|between:0,99.99',
            'itens.*.produtoId' => 'required|int|exists:produto,id',
        ];
    }

    public function messages(): array
    {
        return [
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'enderecoId.exists' => DefaultErrorMessages::NOT_FOUND,
            'tipoEntrega.in' => DefaultErrorMessages::NOT_FOUND,
            'itens.*.produtoId.exists' => DefaultErrorMessages::NOT_FOUND,
            'itens.*.nome.exists' => DefaultErrorMessages::NOT_FOUND,

            'quantidadeItens.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'total.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'tipoEntrega.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'valorEntrega.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'usuarioId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'enderecoId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'itens.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'itens.*.nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'itens.*.preco.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'itens.*.quantidadeItem.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'itens.*.subTotal.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'itens.*.produtoId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'quantidadeItem.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'total.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'valorEntrega.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'enderecoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,

            'itens.array' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
            'itens.*.nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'itens.*.preco.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'itens.*.quantidadeItem.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'itens.*.subTotal.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'itens.*.produtoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
