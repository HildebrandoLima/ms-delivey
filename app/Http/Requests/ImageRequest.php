<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;

class ImageRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'imagens' => 'required|array',
            'imagens.*.nome' => 'required|string',
            'imagens.*.produtoId' => 'required|int|exists:produto,id',
            'imagens.*.ativo' => 'required|int',
        ];
    }

    public function messages()
    {
        return [
            'produtoId.exists' => DefaultErrorMessages::NOT_FOUND,

            'imagens.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'produtoId.required' => DefaultErrorMessages::REQUIRED_FIELD,

            'imagens.array' => DefaultErrorMessages::FIELD_MUST_BE_ARRAY,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
            'produtoId.int' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
