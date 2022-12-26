<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class EditUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usarioId'=> 'required|int|exists:users,id',
            'nome' => 'required|string',
            'email'=> 'required|string',
            'atividade' => 'required|string',
            'genero' => 'required|string',
            'senha' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'usarioId.exists' => DefaultErrorMessages::NOT_FOUND,

            'usarioId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'genero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'usarioId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'nome.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'email.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'atividade.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'genero.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,
        ];
    }
}
