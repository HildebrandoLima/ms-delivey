<?php

namespace App\Http\Requests;

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
            'codigo' => 'required|string|min:10|max:10|exists:password_resets,codigo',
            'password' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i'
        ];
    }

    public function messages()
    {
        return [
            'codigo.exists' => DefaultErrorMessages::NOT_FOUND,
            'codigo.min' => DefaultErrorMessages::MIN_CHARACTERS,
            'codigo.max' => DefaultErrorMessages::MAX_CHARACTERS,
            'password' => DefaultErrorMessages::INVALID_PASSWORD,
            'codigo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'password.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'codigo.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'password.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
