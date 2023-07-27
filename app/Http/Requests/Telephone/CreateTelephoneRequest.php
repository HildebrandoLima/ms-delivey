<?php

namespace App\Http\Requests\Telephone;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateTelephoneRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telefones' => 'required|array',
            'telefones.*.numero' => 'required|string|Celular|unique:telefone,numero|min:10|max:10',
            'telefones.*.tipo' => 'required|string',
            'telefones.*.dddId' => 'required|int|exists:ddd,id',
            'telefones.*.usuarioId' => 'int|exists:users,id',
            'telefones.*.fornecedorId' => 'int|exists:fornecedor,id',
            'telefones.*.ativo' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'telefones.*.numero.unique' => DefaultErrorMessages::ALREADY_EXISTING,

            'telefones.*.dddId.exists' => DefaultErrorMessages::NOT_FOUND,
            'telefones.*.usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'telefones.*.fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'telefones.*.numero.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'telefones.*.numero.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'telefones.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'telefones.*.numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'telefones.*.tipo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'telefones.*.dddId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'telefones.*.ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'telefones.array' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
            'telefones.*.numero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'telefones.*.tipo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'telefones.*.dddId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'telefones.*.usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'telefones.*.fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'telefones.*.ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
