<?php

namespace App\Services\User;

use App\Http\Requests\User\UserRequest;
use App\Infra\Database\Dao\User\DeleteUserDb;
use App\Infra\Database\Dao\Address\DeleteAddressDb;
use App\Infra\Database\Dao\Telephone\DeleteTelephoneDb;

class DeleteUserService
{
    private DeleteUserDb      $deleteUserDb;
    private DeleteAddressDb   $deleteAddressDb;
    private DeleteTelephoneDb $deleteTelephoneDb;

    public function __construct
    (
        DeleteUserDb      $deleteUserDb,
        DeleteAddressDb   $deleteAddressDb,
        DeleteTelephoneDb $deleteTelephoneDb
    )
    {
        $this->deleteUserDb      = $deleteUserDb;
        $this->deleteAddressDb   = $deleteAddressDb;
        $this->deleteTelephoneDb = $deleteTelephoneDb;
    }

    public function deleteUser(UserRequest $request): bool
    {
        $this->deleteUserDb->deleteUser($request);
        $this->deleteAddressDb->deleteAddress($request);
        $this->deleteTelephoneDb->deleteTelephone($request);
        return true;
    }
}
