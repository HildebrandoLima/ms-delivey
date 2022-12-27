<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class CreateAddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logradouro' => 'required|string',
            'descricao'=> 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'cep' => 'required|int',
            'ufId' => 'required|int|exists:unidade_federativa,id',
            'usuarioId' => 'int|exists:users,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
        ];
    }

    public function messages()
    {
        return [
            'ufId.exists' => DefaultErrorMessages::NOT_FOUND,
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'logradouro.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'descricao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'bairro.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cep.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ufId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'logradouro.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'descricao.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'bairro.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'cidade.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'cep.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'ufId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'usuarioId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'fornecedorId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
        ];
    }
}
