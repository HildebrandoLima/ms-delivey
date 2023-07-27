<?php

namespace App\Services\Telephone\Interfaces;

interface DeleteTelephoneServiceInterface
{
    public function deleteTelephone(int $id, bool $active): bool;
}
