<?php

namespace App\Repositories\Interfaces;

use App\Models\Pedido;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function enableDisable(int $id, int $usuarioId, bool $active): bool;
    public function create(Pedido $pedido): int;
    public function getAll(string $search, int $id, bool $active): Collection;
    public function getOne(int $id, bool $active): Collection;
}
