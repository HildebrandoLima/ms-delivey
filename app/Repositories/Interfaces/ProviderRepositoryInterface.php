<?php

namespace App\Repositories\Interfaces;

use App\Models\Fornecedor;
use Illuminate\Support\Collection;

interface ProviderRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(Fornecedor $fornecedor): int;
    public function update(Fornecedor $fornecedor): bool;
    public function getAll(string $search, bool $active): Collection;
    public function getOne(int $id, bool $active): Collection;
    public function getProdutosByProvider(int $id): array;
}
