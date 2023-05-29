<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\TelephoneEnum;

class TelephoneCase
{
    public function typeCase($tipo): string
    {
        return $tipo == 'Fixo' ? TelephoneEnum::TIPO_FIXO : TelephoneEnum::TIPO_CELULAR;
    }
}
