<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseRequest;
use App\Support\Utils\DefaultErrorMessages;

class ProviderRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fornecedorId'=> 'int|exists:fornecedor,id',
            'fornecedorNome' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'fornecedorId.exists' => DefaultErrorMessages::NOT_FOUND,
            'fornecedorId.int' => DefaultErrorMessages::VALIDATION_FAILURE,
            'fornecedorNome.string' => DefaultErrorMessages::VALIDATION_FAILURE,
        ];
    }
}
