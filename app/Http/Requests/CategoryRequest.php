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
            'nome' => 'required|string',
            'ativo' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
