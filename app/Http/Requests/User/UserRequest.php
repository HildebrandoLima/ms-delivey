<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
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
            'usuarioId'=> 'int|exists:users,id',
            'usuarioNome' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'usuarioId.exists' => DefaultErrorMessages::NOT_FOUND,
            'usuarioId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'usuarioNome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRING,
        ];
    }
}
