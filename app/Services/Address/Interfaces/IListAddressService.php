<?php

namespace App\Services\Address\Interfaces;

use Illuminate\Support\Collection;

interface IListAddressService
{
    public function listFederativeUnitAll(): Collection;
}
