<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class AddressRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'enderecoId'=> 'int|exists:endereco,id',
        ];
    }

    public function messages()
    {
        return [
            'enderecoId.exists' => DefaultErrorMessages::NOT_FOUND,
            'enderecoId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
