<?php

namespace App\Services\Address\Interfaces;

interface DeleteAddressServiceInterface
{
    public function deleteAddress(int $id, bool $active): bool;
}
