<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Enums\ProductEnum;
use App\Support\Traits\ValidationPermission;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateProductRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->validationPermission(PermissionEnum::CRIAR_PRODUTO);
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|unique:produto,nome',
            'precoCusto' => 'required|regex:/^\d{1,6}([,.]\d{1,2})?$/',
            'precoVenda' => 'required|regex:/^\d{1,6}([,.]\d{1,2})?$/|gt:precoCusto',
            'codigoBarra' => 'required|string|min:13|max:13|unique:produto,codigo_barra',
            'descricao' => 'required|string',
            'quantidade' => 'required|int',
            'unidadeMedida' => 'required|string|in:' . ProductEnum::UN . ',' . ProductEnum::G . ',' . ProductEnum::KG . ',' . ProductEnum::ML . ',' . ProductEnum::L . ',' . ProductEnum::M2 . ',' . ProductEnum::CX,
            'dataValidade' => 'required|date',
            'categoriaId' => 'required|int|exists:categoria,id',
            'fornecedorId' => 'required|int|exists:fornecedor,id',
            'imagens' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'categoriaId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,
            'unidadeMedida.in' => DefaultErrorMessages::NOT_FOUND,

            'nome.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'codigoBarra.unique' => DefaultErrorMessages::ALREADY_EXISTING,

            'codigoBarra.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'codigoBarra.max' => DefaultErrorMessages::MAX_CHARACTERS,
            'precoVenda.gt' => 'O preço de venda deve ser maior que o preço de custo.',

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
            'imagens.required' => DefaultErrorMessages::REQUIRED_FIELD,

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
            'imagens.array' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
        ];
    }
}
