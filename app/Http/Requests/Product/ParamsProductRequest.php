<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ParamsProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:produto,id',
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
