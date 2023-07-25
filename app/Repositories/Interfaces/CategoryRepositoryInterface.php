<?php

namespace App\Repositories\Interfaces;

use App\Models\Categoria;
use App\Support\Utils\Pagination\Pagination;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function enableDisable(int $id, bool $active): bool;
    public function create(Categoria $categoria): bool;
    public function update(Categoria $categoria): bool;
    public function getAll(Pagination $pagination, int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
