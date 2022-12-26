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
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'genero.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'nome.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'email.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'genero.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,
        ];
    }
}
