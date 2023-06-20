<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\AddressDto;
use Illuminate\Support\Collection;

interface AddressRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(AddressDto $addressDto): bool;
    public function update(int $id, AddressDto $addressDto): bool;
    public function getFederativeUnitAll(): Collection;
}
