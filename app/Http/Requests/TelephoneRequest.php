<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;
use LaravelLegends\PtBrValidator\Rules\Celular;

class TelephoneRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telefones' => 'required|array',
            'telefones.*.numero' => ['required', new Celular()],
            'telefones.*.tipo' => 'required|string',
            'telefones.*.dddId' => 'required|int|exists:ddd,id',
            'telefones.*.usuarioId' => 'int|exists:users,id',
            'telefones.*.fornecedorId' => 'int|exists:fornecedor,id',
            'telefones.*.ativo' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'dddId.exists' => DefaultErrorMessages::NOT_FOUND,
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'numero.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'numero.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'telefones.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'tipo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dddId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'telefones.array' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
            'numero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'tipo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'dddId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
