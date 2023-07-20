<?php

namespace App\Support\Cases;

use App\Support\Enums\AddressEnum;

final class AddressCase
{
    final public static function publicPlaceCase($logradouro): string
    {
        return $logradouro == 'Rua' ? AddressEnum::LOGRADOURO_RUA : AddressEnum::LOGRADOURO_AVENIDA;
    }
}
