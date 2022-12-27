<?php

namespace App\Services\Address;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Infra\Database\Dao\Address\CreateAddressDb;
use App\Support\Utils\Enums\AddressEnums;

class CreateAddressService
{
    private CreateAddressDb $createAddressDb;

    public function __construct(CreateAddressDb $createAddressDb)
    {
        $this->createAddressDb = $createAddressDb;
    }

    public function createAddress(CreateAddressRequest $request): int
    {
        $logradouro = $this->caseLogradouro($request->logradouro);
        return $this->createAddressDb->createAddress($request, $logradouro);
    }

    private function caseLogradouro($logradouro): string
    {
        switch ($logradouro):
            case $logradouro === 'Rua':
                return AddressEnums::LOGRADOURO_RUA;
            case $logradouro === 'Avenida':
                return AddressEnums::LOGRADOURO_AVENIDA;
        endswitch;
    }
}
