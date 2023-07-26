<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\Messages\DefaultErrorMessages;
use LaravelLegends\PtBrValidator\Rules\Cnpj;

class EditProviderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:fornecedor,id',
            'razaoSocial' => 'required|string',
            'cnpj' => ['required', new Cnpj()],
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'ativo' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,

            'razaoSocial.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cnpj.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'ativo.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'razaoSocial.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cnpj.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email' => DefaultErrorMessages::INVALID_EMAIL,
            'ativo.boolean' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
