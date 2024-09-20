<?php

namespace App\Http\Requests\Provider;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;

class PermissonProviderRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::LISTAR_FORNECEDORES);
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
