<?php

namespace App\Repositories\Interface;

use App\Models\Categoria;
use Illuminate\Support\Collection;

interface ICategoryRepository {
    public function insert(Categoria $categoria): bool;
    public function update(int $id, Categoria $categoria): bool;
    public function delete(int $id): bool;
    public function getAll(string $search): Collection;
    public function getFind(int $id): Collection;
}
