<?php

namespace App\Services\Order\Interfaces;

use Illuminate\Support\Collection;

interface ListOrderServiceInterface
{
    public function listOrderAll(int $active): Collection;
    public function listOrderFind(int $id, string $search, int $active): Collection;
}
