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

            'telefoneId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'numero.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'tipo.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'ddd_id.int' => DefaultErrorMessages::VALIDATION_FAILURE,
        ];
    }
}
