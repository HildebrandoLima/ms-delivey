<?php

namespace App\Http\Requests\Telephone;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\TelephoneEnum;
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
            'telefones.*.numero' => 'required|string|celular_com_ddd|unique:telefone,numero|min:14|max:14',
            'telefones.*.tipo' => 'required|string|in:' . TelephoneEnum::TIPO_CELULAR . ',' . TelephoneEnum::TIPO_CELULAR,
            'telefones.*.usuarioId' => 'int|exists:users,id',
            'telefones.*.fornecedorId' => 'int|exists:fornecedor,id',
            'telefones.*.ativo' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'telefones.*.numero.unique' => DefaultErrorMessages::ALREADY_EXISTING,

            'telefones.*.usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'telefones.*.fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,
            'telefones.*.tipo.in' => DefaultErrorMessages::NOT_FOUND,

            'telefones.*.numero.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'telefones.*.numero.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'telefones.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'telefones.*.numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'telefones.*.tipo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'telefones.*.ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'telefones.array' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
            'telefones.*.numero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'telefones.*.tipo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'telefones.*.usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'telefones.*.fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'telefones.*.ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
