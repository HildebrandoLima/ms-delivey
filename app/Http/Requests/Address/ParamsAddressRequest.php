<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ParamsAddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:endereco,id',
            'ativo' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,

            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
