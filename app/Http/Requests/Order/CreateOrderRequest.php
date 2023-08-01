<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Traits\ValidationPermission;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateOrderRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        $this->validationPermission(PermissionEnum::CRIAR_PEDIDO);
        return true;
    }

    public function rules(): array
    {
        return [
            'quantidadeItens' => 'required|int',
            'total' => 'required|between:0,99.99',
            'entrega' => 'required|between:0,99.99',
            'usuarioId' => 'int|exists:users,id',
            'ativo' => 'required|boolean',
            'itens' => 'required|array',
            'itens.*.nome' => 'required|string',
            'itens.*.preco' => 'required|between:0,99.99',
            'itens.*.codigoBarra' => 'required|string|max:13|min:13',
            'itens.*.quantidadeItem' => 'required|int',
            'itens.*.subTotal' => 'required|between:0,99.99',
            'itens.*.unidadeMedida' => 'required|string',
            'itens.*.produtoId' => 'required|int|exists:produto,id',
            'itens.*.ativo' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'produtoId.exists' => DefaultErrorMessages::NOT_FOUND,

            'quantidadeItens.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'total.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'entrega.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'usuarioId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'codigoBarra.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'codigoBarra.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'itens.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'preco.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'codigoBarra.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'quantidadeItem.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'subTotal.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'unidadeMedida.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'produtoId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'quantidadeItem.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'total.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'entrega.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,

            'itens.array' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
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
