<?php

namespace App\Support\Utils\Params;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class FilterByActive extends BaseRequest
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
            'active.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
