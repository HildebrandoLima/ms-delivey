<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\TelephoneEnums;

class TelephoneCase
{
    public function typeCase($tipo)
    {
        if ($tipo == 'Fixo'):
            $tipo = TelephoneEnums::TIPO_FIXO;
        else:
            $tipo = TelephoneEnums::TIPO_CELULAR;
        endif;
        return $tipo;
    }
}
