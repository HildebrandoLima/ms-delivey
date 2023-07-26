<?php

namespace App\Repositories\Interfaces;

use App\Models\Produto;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function enableDisable(int $id, bool $active): bool;
    public function create(Produto $produto): int;
    public function update(Produto $produto): bool;
    public function getAll(Pagination $pagination, string $search, bool $active): Collection;
    public function getOne(int $id, bool $active): Collection;
}
