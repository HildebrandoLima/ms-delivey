<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class ParametersRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'string',
            'search' => 'string',
            'active' => 'required|int'
        ];
    }

    public function messages()
    {
        return [
            'active.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'id.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'search.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'active.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
