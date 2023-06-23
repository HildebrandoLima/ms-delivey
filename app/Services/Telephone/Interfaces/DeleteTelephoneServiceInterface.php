<?php

namespace App\Services\Telephone\Interfaces;

interface DeleteTelephoneServiceInterface
{
    public function deleteTelephone(int $id, int $active): bool;
}
