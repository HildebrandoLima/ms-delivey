<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\CategoryDto;
use App\Models\Categoria;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(Categoria $categoria): bool;
    public function update(int $id, CategoryDto $categoryDto): bool;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
