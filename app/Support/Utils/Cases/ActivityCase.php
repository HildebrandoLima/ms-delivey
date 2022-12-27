<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\UserEnums;

class ActivityCase
{
    private string $atividade;
    public function activityCase($atividade): string
    {
        switch ($atividade):
            case $atividade === '0':
                $this->atividade = UserEnums::DESATIVADO;
            break;
            case $atividade === '1':
                $this->atividade = UserEnums::ATIVADO;
            break;
        endswitch;
        return $this->atividade;
    }
}
