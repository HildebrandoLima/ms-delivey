<?php

namespace App\Services\Provider\Abstracts;

use Illuminate\Support\Collection;

interface IListProviderService
{
    public function listProviderAll(string $search, bool $active): Collection;
    public function listProviderFind(int $id, bool $active): Collection;
}
