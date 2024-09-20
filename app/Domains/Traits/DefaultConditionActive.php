<?php

namespace App\Domains\Traits;

use App\Support\Enums\ActiveEnum;

trait DefaultConditionActive
{
    public function defaultConditionActive(bool $ativo): bool
    {
        return $ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
    }
}
