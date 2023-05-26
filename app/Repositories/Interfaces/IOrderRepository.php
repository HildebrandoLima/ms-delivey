<?php

namespace App\Repositories\Interfaces;

use App\Models\Pedido;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface IOrderRepository {
    public function insert(Pedido $pedido): int;
    public function update(int $id, Pedido $pedido): bool;
    public function delete(int $id): bool;
    public function getAll(Pagination $pagination, string $search): Collection;
    public function getFind(int $id): Collection;
}
