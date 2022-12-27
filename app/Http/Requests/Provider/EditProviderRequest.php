<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class EditProviderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fornecedorId'=> 'required|int|exists:fornecedor,id',
            'nome' => 'required|string',
            'cnpj' => 'required|string',
            'email'=> 'required|string',
            'atividade' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,

            'fornecedorId.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'cnpj.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'email.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'atividade.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'fornecedorId.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'cnpj.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'email.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'atividade.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
