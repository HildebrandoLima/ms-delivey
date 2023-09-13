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
            '*.ddd' => 'required|int|exists:ddd,ddd',
            '*.numero' => 'required|string|celular_com_ddd|unique:telefone,numero|min:14|max:14',
            '*.tipo' => 'required|string|in:' . TelephoneEnum::TIPO_FIXO . ',' . TelephoneEnum::TIPO_CELULAR,
            '*.usuarioId' => 'int|exists:users,id',
            '*.fornecedorId' => 'int|exists:fornecedor,id',
        ];
    }

    public function messages(): array
    {
        return [
            '*.numero.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            '*.numero.min' => DefaultErrorMessages::MIN_CHARACTERS,
            '*.numero.max' => DefaultErrorMessages::MAX_CHARACTERS,

            '*.ddd.exists' => DefaultErrorMessages::NOT_FOUND,
            '*.usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            '*.fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,
            '*.tipo.in' => DefaultErrorMessages::NOT_FOUND,

            '*.ddd.required' => DefaultErrorMessages::REQUIRED_FIELD,
            '*.numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            '*.tipo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            '*.numero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            '*.tipo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            '*.ddd.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            '*.usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            '*.fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
