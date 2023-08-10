<?php

namespace App\Http\Requests\AuthSocial;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class AuthSocialRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'provider' => 'required|string|in:facebook,google,github',
        ];
    }

    public function messages(): array
    {
        return [
            'provider.in' => DefaultErrorMessages::NOT_FOUND,
            'provider.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'provider.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
