<?php

namespace App\Http\Requests\Telephone;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class TelephoneRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telefoneId'=> 'int|exists:telefone,id',
        ];
    }

    public function messages()
    {
        return [
            'telefoneId.exists' => DefaultErrorMessages::NOT_FOUND,
            'telefoneId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
