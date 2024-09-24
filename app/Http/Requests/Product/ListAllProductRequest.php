<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ListAllProductRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'active.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'active.int' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
