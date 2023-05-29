<?php

namespace App\Repositories\Interfaces;

use App\Models\Categoria;
use Illuminate\Support\Collection;

interface ICategoryRepository {
    public function insert(Categoria $categoria): bool;
    public function update(int $id, Categoria $categoria): bool;
    public function delete(int $id): bool;
    public function getAll(int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
