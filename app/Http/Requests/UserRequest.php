<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class UserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'perfilId' => 'required|int|exists:perfil,id',
            'nome' => 'required|string',
            'cpf' => 'required|string|cpf',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'senha' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i',
            'dataNascimento' => 'required|date',
            'genero' => 'required|string',
            'ativo' => 'required|int',
        ];
    }

    public function messages()
    {
        return [
            'perfilId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'perfilId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'perfilId.exists' => DefaultErrorMessages::NOT_FOUND,

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
            'genero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'ativo.int' => DefaultErrorMessages::REQUIRED_FIELD,

            'email' => DefaultErrorMessages::INVALID_EMAIL,
            'senha' => DefaultErrorMessages::INVALID_PASSWORD,
            'dataNascimento.date' => DefaultErrorMessages::INVALID_DATE,
        ];
    }
}
