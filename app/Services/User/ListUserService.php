<?php

namespace App\Services\User;

use App\Http\Requests\User\UserRequest;
use App\Infra\Database\Dao\User\ListUserDb;
use Illuminate\Support\Collection;

class ListUserService
{
    private ListUserDb $listUserDb;

    public function __construct(ListUserDb $listUserDb)
    {
        $this->listUserDb = $listUserDb;
    }

    public function listUserAll(): Collection
    {
        return $this->listUserDb->listUserAll();
    }

    public function listUserFind(UserRequest $request): Collection
    {
        return $this->listUserDb->listUserFind($request);
    }
}
