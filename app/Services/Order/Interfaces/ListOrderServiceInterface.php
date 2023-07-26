<?php

namespace App\Services\Order\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface ListOrderServiceInterface
{
    public function listOrderAll(Pagination $pagination, string $search, int $id, bool $active): Collection;
    public function listOrderFind(int $id, bool $active): Collection;
}
