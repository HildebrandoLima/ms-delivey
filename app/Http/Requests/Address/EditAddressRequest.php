<?php

namespace App\Http\Requests\Address;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class EditAddressRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::EDITAR_ENDERECO);
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:endereco,id',
            'logradouro' => 'required|string',
            'numero' => 'required|int',
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
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,
            'logradouro.in' => DefaultErrorMessages::NOT_FOUND,

            'cep.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'cep.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'logradouro.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'bairro.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cidade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cep.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'uf.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'logradouro.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'numero.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
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
