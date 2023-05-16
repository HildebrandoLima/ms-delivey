<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class CategoryRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descricao' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'descricao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
