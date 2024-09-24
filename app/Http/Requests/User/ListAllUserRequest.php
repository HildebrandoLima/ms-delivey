<?php

namespace App\Http\Requests\User;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ListAllUserRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::LISTAR_USUARIOS);
    }

    public function rules(): array
    {
        return [
            'active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'active.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'active.int' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
