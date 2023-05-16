<?php

namespace App\Support\Utils\Pagination;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class Pagination extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => 'int',
            'perPage' => 'int',
            'search' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'page.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'perPage.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'search.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'page.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'perPage.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'search.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
