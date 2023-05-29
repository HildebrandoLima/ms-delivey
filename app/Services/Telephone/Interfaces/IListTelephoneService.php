<?php

namespace App\Services\Telephone\Interfaces;

use Illuminate\Support\Collection;

interface IListTelephoneService
{
    public function listDDDAll(): Collection;
    public function listTelephoneAll(int $id, int $active): Collection;
}
