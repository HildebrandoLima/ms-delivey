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

            'enderecoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ufId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'logradouro.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'descricao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'bairro.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cidade.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cep.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
