<?php

namespace App\Http\Requests\User;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ListFindByIdUserRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::LISTAR_DETALHES_USUARIO);
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:users,id',
            'active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER,

            'active.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'active.int' => DefaultErrorMessages::FIELD_MUST_BE_BOOLEAN,
        ];
    }
}
