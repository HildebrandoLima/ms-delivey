<?php

namespace App\Services\Telephone;

use App\Http\Requests\User\UserRequest;
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

    public function listTelephoneAll(UserRequest $request): Collection
    {
        return $this->listTelephoneDb->listTelephoneAll($request);
    }
}
