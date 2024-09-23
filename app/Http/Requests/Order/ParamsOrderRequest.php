<?php

namespace App\Http\Requests\Order;

use App\Domains\Traits\ValidationPermission;
use App\Http\Requests\BaseRequest;
use App\Support\Enums\PermissionEnum;
use App\Support\Utils\Messages\DefaultErrorMessages;

class ParamsOrderRequest extends BaseRequest
{
    use ValidationPermission;

    public function authorize(): bool
    {
        return $this->hasPermission(PermissionEnum::LISTAR_DETALHES_PEDIDO);
    }

    public function rules(): array
    {
        return [
            'id' => 'required|int|exists:pedido,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => DefaultErrorMessages::NOT_FOUND,
            'id.required' => DefaultErrorMessages::REQUIRED_FIELD,
            'id.int' => DefaultErrorMessages::FIELD_MUST_BE_INTEGER
        ];
    }
}
