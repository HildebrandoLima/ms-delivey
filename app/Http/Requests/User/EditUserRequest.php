<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class EditUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:users,id',
            'nome' => 'required|string',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'genero' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,

            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'genero.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'genero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,

            'email' => DefaultErrorMessages::INVALID_EMAIL,
        ];
    }
}