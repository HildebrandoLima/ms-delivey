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
            'email' => 'required|string',
            'password' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'password.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'password.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
