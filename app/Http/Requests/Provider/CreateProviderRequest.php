<?php

namespace App\Http\Requests\Provider;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateProviderRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->validationPermission(PermissionEnum::CRIAR_FORNECEDOR);
    }

    public function rules(): array
    {
        return [
            'razaoSocial' => 'required|string|unique:fornecedor,razao_social',
            'cnpj' => 'required|string|formato_cnpj|unique:fornecedor,cnpj',
            'email' => 'required|string|unique:fornecedor,email|regex:/(.+)@(.+)\.(.+)/i',
            'dataFundacao' => 'required|date',
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

            'razaoSocial.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cnpj.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email' => DefaultErrorMessages::INVALID_EMAIL,
            'dataFundacao.date' => DefaultErrorMessages::INVALID_DATE,
        ];
    }
}
