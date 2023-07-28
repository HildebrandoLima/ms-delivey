<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class RefreshPasswordRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required|string|exists:password_resets,token',
            'codigo' => 'required|string|min:10|max:10|exists:password_resets,codigo',
            'senha' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i'
        ];
    }

    public function messages(): array
    {
        return [
            'token.exists' => DefaultErrorMessages::NOT_FOUND,
            'codigo.exists' => DefaultErrorMessages::NOT_FOUND,

            'codigo.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'codigo.max' => DefaultErrorMessages::MAX_CHARACTERS,

            'token.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'codigo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'senha.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'token.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'codigo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'senha.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,

            'senha' => DefaultErrorMessages::INVALID_PASSWORD,
        ];
    }
}
