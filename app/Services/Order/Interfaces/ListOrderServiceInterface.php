<?php

namespace App\Services\Order\Interfaces;

use Illuminate\Support\Collection;

interface ListOrderServiceInterface
{
    public function listOrderAll(string $search, int $id, bool $filter): Collection;
    public function listOrderFind(int $id, bool $filter): Collection;
}
