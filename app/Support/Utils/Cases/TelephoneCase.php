<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\TelephoneEnums;

class TelephoneCase
{
    public function typeCase($tipo): string
    {
        return $tipo == 'Fixo' ? TelephoneEnums::TIPO_FIXO : TelephoneEnums::TIPO_CELULAR;
    }
}
