<?php

namespace App\Services\Order\Interfaces;

use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IListOrderService
{
    public function listOrderAll(Pagination $pagination, string $search): Collection;
    public function listOrderFind(int $id): Collection;
}
