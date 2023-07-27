<?php

namespace App\Services\Provider\Interfaces;

use Illuminate\Support\Collection;

interface ListProviderServiceInterface
{
    public function listProviderAll(string $search, bool $active): Collection;
    public function listProviderFind(int $id, bool $active): Collection;
}
