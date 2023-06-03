<?php

namespace App\Services\Provider\Interfaces;

use Illuminate\Support\Collection;

interface IListProviderService
{
    public function listProviderAll(int $active): Collection;
    public function listProviderFind(int $id, string $search, int $activ): Collection;
}
