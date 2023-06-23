<?php

namespace App\Services\Address\Interfaces;

use Illuminate\Support\Collection;

interface ListAddressServiceInterface
{
    public function listFederativeUnitAll(): Collection;
}
