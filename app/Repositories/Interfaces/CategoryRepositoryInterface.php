<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\CategoryDto;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(CategoryDto $categoryDto): bool;
    public function update(int $id, CategoryDto $categoryDto): bool;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
