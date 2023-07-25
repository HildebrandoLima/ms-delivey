<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ParamsCategoryRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:categoria,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
