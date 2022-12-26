<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class EditAddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'enderecoId' => 'required|int|exists:endereco,id',
            'ufId' => 'required|int|exists:unidade_federativa,id',
            'logradouro' => 'required|string',
            'descricao'=> 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'cep' => 'required|int',
        ];
    }

    public function messages()
    {
        return [
            'enderecoId.exists' => DefaultErrorMessages::NOT_FOUND,
            'ufId.exists' => DefaultErrorMessages::NOT_FOUND,

            'enderecoId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ufId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'logradouro.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'descricao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'bairro.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cep.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'enderecoId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'ufId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'logradouro.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'descricao.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'bairro.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'cidade.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'cep.int' => DefaultErrorMessages::VALIDATION_FAILURE,
        ];
    }
}
