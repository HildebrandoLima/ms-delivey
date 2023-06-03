<?php

namespace App\Repositories\Interfaces;

use App\Models\Pedido;
use Illuminate\Support\Collection;

interface IOrderRepository {
    public function create(Pedido $pedido): int;
    public function update(int $id, Pedido $pedido): bool;
    public function delete(int $id): bool;
    public function getAll(int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
