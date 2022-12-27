<?php

namespace App\Services\Address;

use App\Http\Requests\Address\EditAddressRequest;
use App\Infra\Database\Dao\Address\EditAddressDb;
use App\Support\Utils\Cases\PublicPlaceCase;

class EditAddressService
{
    private EditAddressDb $editAddressDb;

    public function __construct(EditAddressDb $editAddressDb)
    {
        $this->editAddressDb = $editAddressDb;
    }

    public function editAddress(EditAddressRequest $request): bool
    {
        $logradouro = $this->caseLogradouro($request->logradouro);
        return $this->editAddressDb->editAddress($request, $logradouro);
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
