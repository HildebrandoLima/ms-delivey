<?php

namespace App\Repositories;

use App\Models\Pedido;
use App\Repositories\Interfaces\IOrderRepository;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

class OrderRepository implements IOrderRepository {
    public function insert(Pedido $pedido): int
    {
        return 1;
    }

    public function update(int $id, Pedido $pedido): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return true;
    }

    public function getAll(Pagination $pagination, string $search): Collection
    {
        return collect();
    }

    public function getFind(int $id): Collection
    {
        return collect();
    }
}
