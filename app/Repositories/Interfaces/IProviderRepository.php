<?php

namespace App\Repositories\Interfaces;

use App\Models\Fornecedor;
use Illuminate\Support\Collection;

interface IProviderRepository {
    public function create(Fornecedor $fornecedor): int;
    public function update(int $id, Fornecedor $fornecedor): bool;
    public function delete(int $id): bool;
    public function getAll(int $active): Collection;
    public function getFind(int $id, string $search, int $active): Collection;
}
