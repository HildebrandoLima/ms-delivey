<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Traits\ValidationPermission;
use App\Support\Utils\Messages\DefaultErrorMessages;

class CreateCategoryRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        $this->validationPermission(PermissionEnum::CRIAR_CATEGORIA);
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|unique:categoria,nome',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.unique' => DefaultErrorMessages::ALREADY_EXISTING,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
