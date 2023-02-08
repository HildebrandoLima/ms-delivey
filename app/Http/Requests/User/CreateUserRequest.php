<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class CreateUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'email'=> 'required|string',
            'genero' => 'required|string',
            'senha' => 'required|string',
            'cpf' => 'required|string',
            'data_nascimento' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'genero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cpf.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'data_nascimento.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'genero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'senha.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cpf.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'data_nascimento.date' => DefaultErrorMessages::INVALID_DATE,
        ];
    }
}