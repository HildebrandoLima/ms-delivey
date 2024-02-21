<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Traits\ValidationPermission;

class PermissonUserRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->validationPermission(PermissionEnum::LISTAR_USUARIOS);
    }

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
