<?php

namespace App\Services\Provider\Interfaces;

use Illuminate\Support\Collection;

interface ListProviderServiceInterface
{
    public function listProviderAll(int $active): Collection;
    public function listProviderFind(int $id, string $search, int $activ): Collection;
}
