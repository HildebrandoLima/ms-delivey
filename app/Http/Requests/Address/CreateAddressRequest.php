<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\AddressEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateAddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'logradouro' => 'required|string|in:' . AddressEnum::LOGRADOURO_RUA->value . ',' . AddressEnum::LOGRADOURO_AVENIDA->value,
            'descricao' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'cep' => 'required|string|formato_cep|min:9|max:9',
            'uf' => 'required|string|uf',
            'usuarioId' => 'int|exists:users,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,
            'logradouro.in' => DefaultErrorMessages::NOT_FOUND,

            'cep.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'cep.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'logradouro.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'descricao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'bairro.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cep.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'uf.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'logradouro.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'descricao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'bairro.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cidade.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cep.string' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'uf.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
