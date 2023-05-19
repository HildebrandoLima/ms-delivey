<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class ProviderRequest extends BaseRequest
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
            'email' => 'required|string',
            'dataFundacao' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cnpj.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dataFundacao.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cnpj.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'dataFundacao.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
