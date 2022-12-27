<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Enums\AddressEnums;

class PublicPlaceCase
{
    private string $logradouro;
    public function publicPlaceCase($logradouro): string
    {
        switch ($logradouro):
            case $logradouro === 'Rua':
                $this->logradouro = AddressEnums::LOGRADOURO_RUA;
                break;
            case $logradouro === 'Avenida':
                $this->logradouro = AddressEnums::LOGRADOURO_AVENIDA;
                break;
        endswitch;
        return $this->logradouro;
    }
}
