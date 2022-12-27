<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\TelephoneEnums;

class TypeCase
{
    private string $tipo;
    public function typeCase($tipo): string
    {
        switch ($tipo):
            case $tipo === 'Fixo':
                $this->tipo = TelephoneEnums::TIPO_FIXO;
                break;
            case $tipo === 'Celular':
                $this->tipo = TelephoneEnums::TIPO_CELULAR;
                break;
        endswitch;
        return $this->tipo;
    }
}
