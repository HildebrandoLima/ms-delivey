<?php

namespace App\Services\Address;

use App\Infra\Database\Dao\Address\ListAddressDb;
use Illuminate\Support\Collection;

class ListAddressService
{
    private ListAddressDb $listAddressDb;

    public function __construct(ListAddressDb $listAddressDb)
    {
        $this->listAddressDb = $listAddressDb;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->listAddressDb->listFederativeUnitAll();
    }

    public function listAddressAll(int $userId): Collection
    {
        return $this->listAddressDb->listAddressAll($userId);
    }
}
