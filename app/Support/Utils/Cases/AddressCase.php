<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\AddressEnum;

class AddressCase
{
    public function publicPlaceCase($logradouro): string
    {
        return $logradouro == 'Rua' ? AddressEnum::LOGRADOURO_RUA : AddressEnum::LOGRADOURO_AVENIDA;
    }
}
