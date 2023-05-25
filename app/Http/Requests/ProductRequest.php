<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class ProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'precoCusto' => 'required|between:0,99.99',
            'precoVenda' => 'required|between:0,99.99',
            'codigoBarra' => 'required|string|min:13|max:13',
            'descricao' => 'required|string',
            'quantidade' => 'required|int',
            'unidadeMedida' => 'required|string',
            'dataValidade' => 'required|date',
            'ativo' => 'required|int',
            'categoriaId' => 'int|exists:categoria,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'imagens' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'categoriaId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'codigoBarra.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'codigoBarra.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'precoCusto.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'precoVenda.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'codigoBarra.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'descricao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'quantidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'unidadeMedida.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dataValidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'categoriaId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'fornecedorId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'imagens.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'precoCusto.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'precoVenda.between' => DefaultErrorMessages::FIELD_MUST_BE_DECIMAL,
            'codigoBarra.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'descricao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'quantidade.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'unidadeMedida.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'dataValidade.string' => DefaultErrorMessages::INVALID_DATE,
            'ativo.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'categoriaId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'imagens.int' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
        ];
    }
}
