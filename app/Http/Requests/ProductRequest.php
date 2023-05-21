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
            'precoCusto' => 'required|int',
            'precoVenda' => 'required|int',
            'codigoBarra' => 'required|string',
            'descricao' => 'required|string',
            'quantidade' => 'required|int',
            'unidadeMedida' => 'required|string',
            'ativo' => 'required|int',
            'dataValidade' => 'required|date',
            'fornecedorId' => 'int|exists:fornecedor,id',
        ];
    }

    public function messages()
    {
        return [
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'precoCusto.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'precoVenda.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'codigoBarra.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'descricao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'quantidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'unidadeMedida.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dataValidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'fornecedorId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'precoCusto.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'precoVenda.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'codigoBarra.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'descricao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'quantidade.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'unidadeMedida.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'ativo.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'dataValidade.string' => DefaultErrorMessages::INVALID_DATE,
            'fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
