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
            'usuarioId'=> 'required|int|exists:users,id',
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
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,

            'usuarioId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'atividade.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'genero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRING,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRING,
            'atividade.string' => DefaultErrorMessages::FIELD_MUST_BE_STRING,
            'genero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRING,
            'senha.string' => DefaultErrorMessages::FIELD_MUST_BE_STRING,
        ];
    }
}
