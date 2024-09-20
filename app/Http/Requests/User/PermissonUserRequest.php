<?php

namespace App\Http\Requests\User;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;

class PermissonUserRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::LISTAR_USUARIOS);
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
