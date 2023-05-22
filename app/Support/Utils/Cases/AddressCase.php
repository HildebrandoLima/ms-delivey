<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\AddressEnums;

class AddressCase
{
    public function publicPlaceCase($logradouro): string
    {
        if ($logradouro == 'Rua'):
            $logradouro = AddressEnums::LOGRADOURO_RUA;
        else:
            $logradouro = AddressEnums::LOGRADOURO_AVENIDA;
        endif;
        return $logradouro;
    }
}
