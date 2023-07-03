<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;
use LaravelLegends\PtBrValidator\Rules\Cnpj;

class ProviderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'razaoSocial' => 'required|string',
            'cnpj' => ['required', new Cnpj()],
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'dataFundacao' => 'required|date',
            'ativo' => 'required|int'
        ];
    }

    public function messages()
    {
        return [
            'razaoSocial.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cnpj.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'dataFundacao.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'razaoSocial.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cnpj.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email' => DefaultErrorMessages::INVALID_EMAIL,
            'dataFundacao.date' => DefaultErrorMessages::INVALID_DATE,
            'ativo.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
