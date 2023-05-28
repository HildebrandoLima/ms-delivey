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
            'ativo' => 'required|int'
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'descricao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'ativo.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
