<?php

namespace App\Services\Address\Interfaces;

interface IDeleteAddressService
{
    public function deleteAddress(int $id): bool;
}
