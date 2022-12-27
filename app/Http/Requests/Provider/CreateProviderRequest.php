<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class CreateProviderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'cnpj' => 'required|string',
            'email'=> 'required|string',
            'data_fundacao' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cnpj.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'data_fundacao.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'nome.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'cnpj.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'email.string' => DefaultErrorMessages::VALIDATION_FAILURE,
            'data_fundacao.string' => DefaultErrorMessages::VALIDATION_FAILURE,
        ];
    }
}
