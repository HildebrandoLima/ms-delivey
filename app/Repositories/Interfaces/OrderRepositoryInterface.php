<?php

namespace App\Repositories\Interfaces;

use App\Models\Pedido;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function enableDisable(int $id, int $usuarioId, int $active): bool;
    public function create(Pedido $pedido): int;
    public function getAll(int $id, int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
