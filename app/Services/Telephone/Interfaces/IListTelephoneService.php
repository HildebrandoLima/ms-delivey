<?php

namespace App\Services\Telephone\Interfaces;

use Illuminate\Support\Collection;

interface IListTelephoneService
{
    public function listDDDAll(): Collection;
}
