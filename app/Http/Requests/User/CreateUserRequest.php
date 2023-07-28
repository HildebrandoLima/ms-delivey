<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|unique:users,name',
            'cpf' => 'required|string|formato_cpf|unique:users,cpf|min:14|max:14',
            'email' => 'required|string|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'senha' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i',
            'dataNascimento' => 'required|date',
            'genero' => 'required|string',
            'perfil' => 'required|boolean',
            'ativo' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'cpf.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'email.unique' => DefaultErrorMessages::ALREADY_EXISTING,

            'cpf.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'cpf.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cpf.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dataNascimento.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'genero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'perfil.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cpf.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'senha.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'genero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'perfil.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,

            'email' => DefaultErrorMessages::INVALID_EMAIL,
            'senha' => DefaultErrorMessages::INVALID_PASSWORD,
            'dataNascimento.date' => DefaultErrorMessages::INVALID_DATE,
        ];
    }
}
