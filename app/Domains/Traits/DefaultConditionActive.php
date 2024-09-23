<?php

namespace App\Domains\Traits;

use App\Support\Enums\ActiveEnum;

trait DefaultConditionActive
{
    protected function defaultConditionActive(bool $ativo): bool
    {
        return $ativo == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO;
    }
}
