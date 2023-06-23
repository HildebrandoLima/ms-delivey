<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\OrderDto;
use App\Models\Pedido;
use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function enableDisable(int $id, int $usuarioId, int $active): bool;
    public function create(OrderDto $orderDto): Pedido;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
