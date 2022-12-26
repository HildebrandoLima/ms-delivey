<?php

namespace App\Http\Requests\Telephone;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class CreateTelephoneRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero' => 'required|string',
            'tipo'=> 'required|string',
            'dddId' => 'required|int|exists:ddd,id',
            'usuarioId' => 'required|int|exists:users,id',
            'fornecedorId' => 'required|int|exists:fornecedor,id',
        ];
    }

    public function messages()
    {
        return [
            'dddId.exists' => DefaultErrorMessages::NOT_FOUND,
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'numero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'tipo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ddd_id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'usuarioId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'fornecedorId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'numero.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'tipo.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'ddd_id.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'usuarioId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'fornecedorId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
        ];
    }
}
