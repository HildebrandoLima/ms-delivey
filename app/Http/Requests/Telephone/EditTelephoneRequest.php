<?php

namespace App\Http\Requests\Telephone;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Enums\TelephoneEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class EditTelephoneRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::EDITAR_TELEFONE);
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:telefone,id',
            'telefones.*.ddd' => 'required|int|exists:ddd,ddd',
            'numero' => 'required|string|celular_com_ddd|min:14|max:14',
            'telefones.*.tipo' => 'required|string|in:' . TelephoneEnum::TIPO_FIXO . ',' . TelephoneEnum::TIPO_CELULAR,
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
            'telefones.*.ddd.exists' => DefaultErrorMessages::NOT_FOUND,
            'tipo.in' => DefaultErrorMessages::NOT_FOUND,

            'numero.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'numero.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'tipo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'numero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'tipo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
