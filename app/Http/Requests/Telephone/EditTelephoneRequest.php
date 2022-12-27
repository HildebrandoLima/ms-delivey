<?php

namespace App\Http\Requests\Telephone;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class EditTelephoneRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telefoneId' => 'required|int|exists:telefone,id',
            'numero' => 'required|string',
            'tipo'=> 'required|string',
            'dddId' => 'required|int|exists:ddd,id',
        ];
    }

    public function messages()
    {
        return [
            'telefoneId.exists' => DefaultErrorMessages::NOT_FOUND,
            'dddId.exists' => DefaultErrorMessages::NOT_FOUND,
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'telefoneId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'tipo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ddd_id.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'telefoneId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'numero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'tipo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'ddd_id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
