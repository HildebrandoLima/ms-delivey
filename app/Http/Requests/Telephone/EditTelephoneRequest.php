<?php

namespace App\Http\Requests\Telephone;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Messages\DefaultErrorMessages;

class EditTelephoneRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_TELEFONE);
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:telefone,id',
            'numero' => 'required|string|Celular|min:10|max:10',
            'tipo' => 'required|string',
            'dddId' => 'required|int|exists:ddd,id',
            'usuarioId' => 'int|exists:users,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'dddId.exists' => DefaultErrorMessages::NOT_FOUND,
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'numero.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'numero.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'tipo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dddId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'numero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'tipo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'dddId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
