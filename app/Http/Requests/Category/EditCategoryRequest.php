<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Traits\ValidationPermission;
use App\Support\Utils\Messages\DefaultErrorMessages;

class EditCategoryRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_CATEGORIA);
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:categoria,id',
            'nome' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'nome.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'nome.string' => DefaultErrorMessages::FIELD_MUST_BE_STRINGER,
        ];
    }
}
