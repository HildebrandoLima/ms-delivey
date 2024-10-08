<?php

namespace App\Http\Requests\Product;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Enums\ProductEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class UpdateProductRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::EDITAR_PRODUTO);
    }

    public function rules(): array
    {
        return [
            'id' => 'int|exists:produto,id',
            'nome' => 'required|string',
            'precoCusto' => 'required|regex:/^\d{1,6}([,.]\d{1,2})?$/',
            'precoVenda' => 'required|regex:/^\d{1,6}([,.]\d{1,2})?$/|gt:precoCusto',
            'codigoBarra' => 'required|string|min:13|max:13',
            'descricao' => 'required|string',
            'quantidade' => 'required|int',
            'unidadeMedida' => 'required|string|in:' . ProductEnum::UN . ',' . ProductEnum::G . ',' . ProductEnum::KG . ',' . ProductEnum::ML . ',' . ProductEnum::L . ',' . ProductEnum::M2 . ',' . ProductEnum::CX,
            'dataValidade' => 'required|date',
            'categoriaId' => 'int|exists:categoria,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'categoriaId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,
            'unidadeMedida.in' => DefaultErrorMessages::NOT_FOUND,

            'codigoBarra.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'codigoBarra.max' => DefaultErrorMessages::MAX_CHARACTERS,
            'precoVenda.gt' => 'O preço de venda deve ser maior que o preço de custo.',

            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'precoCusto.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'precoVenda.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'codigoBarra.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'descricao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'quantidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'unidadeMedida.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dataValidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'categoriaId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'fornecedorId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'precoCusto.regex' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'precoVenda.regex' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'codigoBarra.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'descricao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'quantidade.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'unidadeMedida.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'dataValidade.string' => DefaultErrorMessages::INVALID_DATE,
            'categoriaId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
