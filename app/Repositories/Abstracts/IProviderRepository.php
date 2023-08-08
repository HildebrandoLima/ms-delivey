<?php

namespace App\Repositories\Abstracts;

use Illuminate\Support\Collection;

interface IProviderRepository
{
    public function readAll(string $search, bool $filter): Collection;
    public function readOne(int $id, bool $filter): Collection;
}
