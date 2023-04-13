<?php

namespace App\Services\Telephone;

use App\Infra\Database\Dao\Telephone\ListTelephoneDb;
use Illuminate\Support\Collection;

class ListTelephoneService
{
    private ListTelephoneDb $listTelephoneDb;

    public function __construct(ListTelephoneDb $listTelephoneDb)
    {
        $this->listTelephoneDb = $listTelephoneDb;
    }

    public function listDDDAll(): Collection
    {
        return $this->listTelephoneDb->listDDDAll();
    }

    public function listTelephoneAll(int $userId): Collection
    {
        return $this->listTelephoneDb->listTelephoneAll($userId);
    }
}
