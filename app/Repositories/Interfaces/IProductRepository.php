<?php

namespace App\Repositories\Interfaces;

use App\Models\Produto;
use Illuminate\Support\Collection;

interface IProductRepository {
    public function create(Produto $produto): int;
    public function update(int $id, Produto $produto): bool;
    public function delete(int $id): bool;
    public function getAll(int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
