<?php

namespace App\Services\User\Interfaces;

interface DeleteUserServiceInterface
{
    public function deleteUser(int $id, int $active): bool;
}
