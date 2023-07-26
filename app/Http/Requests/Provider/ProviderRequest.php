<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseRequest;
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
            'razaoSocial' => 'required|string|unique:fornecedor,razao_social',
            'cnpj' => ['required', new Cnpj()],
            'email' => 'required|string|unique:fornecedor,email|regex:/(.+)@(.+)\.(.+)/i',
            'dataFundacao' => 'required|date',
            'ativo' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'razaoSocial.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'cnpj.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'email.unique' => DefaultErrorMessages::ALREADY_EXISTING,

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
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
