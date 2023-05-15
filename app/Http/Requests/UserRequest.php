<?php

namespace App\Http\Requests;

use App\Support\Utils\DefaultErrorMessages;

class UserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'cpf' => 'required|string',
            'email' => 'required|string',
            'senha' => 'required|string',
            'dataNascimento' => 'required|date',
            'genero' => 'required|string',
            'ativo' => 'required|int'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cpf.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dataNascimento.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'genero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cpf.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'senha.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'dataNascimento.date' => DefaultErrorMessages::INVALID_DATE,
            'genero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'ativo.int' => DefaultErrorMessages::REQUIRED_FIELD,
        ];
    }
}
