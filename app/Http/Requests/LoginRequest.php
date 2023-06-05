<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class LoginRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i'
        ];
    }

    public function messages()
    {
        return [
            'email' => DefaultErrorMessages::INVALID_EMAIL,
            'password' => DefaultErrorMessages::INVALID_PASSWORD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'password.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'password.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
