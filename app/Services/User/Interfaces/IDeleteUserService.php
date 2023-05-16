<?php

namespace App\Services\User\Interfaces;

interface IDeleteUserService
{
    public function deleteUser(int $id): bool;
}
