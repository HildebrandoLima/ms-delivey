<?php

namespace App\Support\Cases;

use App\Support\Utils\Enums\TelephoneEnum;

final class TelephoneCase
{
    final public static function typeCase($tipo): string
    {
        return $tipo == 'Fixo' ? TelephoneEnum::TIPO_FIXO : TelephoneEnum::TIPO_CELULAR;
    }
}
