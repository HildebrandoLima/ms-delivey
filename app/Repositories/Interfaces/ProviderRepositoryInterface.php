<?php

namespace App\Repositories\Interfaces;

use App\Models\Fornecedor;
use Illuminate\Support\Collection;

interface ProviderRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(Fornecedor $fornecedor): int;
    public function update(int $id, Fornecedor $fornecedor): bool;
    public function getAll(int $active): Collection;
    public function getOne(int $id, string $search, int $active): Collection;
}
