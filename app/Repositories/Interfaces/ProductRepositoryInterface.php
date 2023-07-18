<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\ProductDto;
use App\Models\Produto;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(Produto $produto): int;
    public function update(int $id, ProductDto $productDto): bool;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
