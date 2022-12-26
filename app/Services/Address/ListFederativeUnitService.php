<?php

namespace App\Services\Address;

use App\Infra\Database\Dao\Address\ListFederativeUnitDb;
use Illuminate\Support\Collection;

class ListFederativeUnitService
{
    private ListFederativeUnitDb $listFederativeUnitDb;

    public function __construct(ListFederativeUnitDb $listFederativeUnitDb)
    {
        $this->listFederativeUnitDb = $listFederativeUnitDb;
    }

    public function listFederativeUnitAll(): Collection
    {
        return $this->listFederativeUnitDb->listFederativeUnitAll();
    }
}
