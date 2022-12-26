<?php

namespace App\Services\User;

use App\Http\Requests\User\UserRequest;
use App\Infra\Database\Dao\User\DeleteUserDb;
use App\Infra\Database\Dao\Address\DeleteAddressDb;

class DeleteUserService
{
    private DeleteUserDb    $deleteUserDb;
    private DeleteAddressDb $deleteAddressDb;

    public function __construct(DeleteUserDb $deleteUserDb, DeleteAddressDb $deleteAddressDb)
    {
        $this->deleteUserDb    = $deleteUserDb;
        $this->deleteAddressDb = $deleteAddressDb;
    }

    public function deleteUser(UserRequest $request): bool
    {
        $this->deleteUserDb->deleteUser($request);
        $this->deleteAddressDb->deleteAddress($request);
        return true;
    }
}
