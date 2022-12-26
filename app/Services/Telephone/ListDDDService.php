<?php

namespace App\Services\Telephone;

use App\Infra\Database\Dao\Telephone\ListDDDDb;
use Illuminate\Support\Collection;

class ListDDDService
{
    private ListDDDDb $listDDDDb;

    public function __construct(ListDDDDb $listDDDDb)
    {
        $this->listDDDDb = $listDDDDb;
    }

    public function listDDDAll(): Collection
    {
        return $this->listDDDDb->listDDDAll();
    }
}
