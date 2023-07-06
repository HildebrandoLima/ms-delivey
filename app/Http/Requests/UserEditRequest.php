<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class UserEditRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'perfil' => 'required|boolean',
            'nome' => 'required|string',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'genero' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'perfil.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'genero.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'perfil.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'genero.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,

            'email' => DefaultErrorMessages::INVALID_EMAIL,
        ];
    }
}
