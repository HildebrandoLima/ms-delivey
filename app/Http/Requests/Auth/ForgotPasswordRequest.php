<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ForgotPasswordRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i|min:8|exists:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'email' => DefaultErrorMessages::INVALID_EMAIL,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.exists' => DefaultErrorMessages::NOT_FOUND,
            'email.min' => DefaultErrorMessages::MIN_CHARACTERS,
        ];
    }
}
