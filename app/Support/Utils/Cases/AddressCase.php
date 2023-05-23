<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\AddressEnums;

class AddressCase
{
    public function publicPlaceCase($logradouro): string
    {
        return $logradouro == 'Rua' ? AddressEnums::LOGRADOURO_RUA : AddressEnums::LOGRADOURO_AVENIDA;
    }
}
