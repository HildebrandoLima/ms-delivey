<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ParamsUserRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        $this->validationPermission(PermissionEnum::LISTAR_DETALHES_USUARIO);
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,
        ];
    }
}
