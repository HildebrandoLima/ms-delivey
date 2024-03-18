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
        ];
    }

    public function messages(): array
    {
        return [
            'page.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'perPage.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
